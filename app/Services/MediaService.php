<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
	DB,
    Storage
};
use Spatie\QueryBuilder\{
    AllowedFilter,
    QueryBuilder
};

class MediaService extends AbstractService
{
	protected $model = Media::class;
	protected $storage;

	public function __construct()
	{
        $this->storage = Storage::disk('local');
	}

	public function index(Request $properties): LengthAwarePaginator
	{
		$payload = QueryBuilder::for(Media::class)
			->allowedFilters([
				AllowedFilter::exact('id', 'mediable_id'),
				AllowedFilter::partial('type', 'mediable_type'),
			])
			->allowedSorts([
				'created_at',
			])
			->defaultSort('-created_at')
			->paginate($properties->query('per_page'))
			->appends($properties->query());

		return $payload;
	}

	public function store(array $properties): Model|null
	{
		$upload = DB::transaction(function () use ($properties) {
			unset($properties['media']);

			if ($properties['request']->hasFile('media')) {
				$path = 'public/medias';

				if (! $this->storage->exists($path)) {
					$this->storage->makeDirectory($path);
				}
				
				$properties['url'] = $properties['request']->media->store($path, 'local');

				if (! str_contains($properties['url'], $path)) {
					throw new \Exception('something went wrong');
				}
			}

			return Media::create($properties);
		});

		return $upload;
	}

	public function update(array $properties, int|Model $resource): Model|null
	{
		$resource = DB::transaction(function () use ($properties, $resource) {
			unset($data['media']);

			if ($properties['request']->hasFile('media')) {
				$path = 'medias';

				if ($this->storage->exists($resource->url)) {
					$this->storage->delete($resource->url);
				}

				if (! $this->storage->exists($path)) {
					$this->storage->makeDirectory($path);
				}

				$data['path'] = $properties['request']->media->store($path, 'local');

				if (! str_contains($data['url'], $path)) {
					throw new \Exception('something went wrong');
				}
			}

			$resource->update($data);

			return $resource;
		});

		return $resource;
	}

	public function destroy(int|Model $resource, array $aux = null): Model|null
	{
		DB::transaction(function () use ($resource) {
			if ($this->storage->exists($resource->path)) {
				$this->storage->delete($resource->path);
			}

			$resource->delete();
		});

		return $resource;
	}
}
