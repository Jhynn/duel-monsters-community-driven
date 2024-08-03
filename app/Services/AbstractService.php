<?php

namespace App\Services;

use App\Contracts\ServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbstractService implements ServiceInterface
{
	protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    private function resolveModel()
    {
        return app($this->model);
    }

    /**
	 * @inheritDoc 
	 */
	public function index(Request $properties): LengthAwarePaginator
    {
        return $this->model->paginate($properties->query('per_page') ?? 15);
    }

	/**
	 * @inheritDoc
	 */
	public function store(array $properties): Model|null
    {
        $tmp = DB::transaction(function() use ($properties) {
            return $this->model->create($properties);
        });

        return $tmp;
    }

    /**
	 * @inheritDoc
	 */
	public function show(int|Model $resource, array $relations=null): Model|null
    {
        if (gettype($resource) == 'integer')
            $resource = $this->model->findOrFail($resource);

        if (isset($relations))
            $resource = $resource->loadMissing($relations);

        return $resource;
    }

	/**
	 * @inheritDoc
	 */
	public function update(array $properties, int|Model $resource): Model|null
    {
        $tmp = DB::transaction(function() use ($properties, $resource) {
            $tmp = $this->show($resource);
            $tmp->update($properties);

            return $tmp;
        });

        return $tmp;
    }

	/**
	 * @inheritDoc
	 */
	public function destroy(int|Model $resource, array $aux=null): Model|null
    {
        $resource = DB::transaction(function() use ($aux, $resource) {
            $tmp = $this->show($resource);
            $tmp->delete();

            return $tmp;
        });

        return $resource;
    }
}
