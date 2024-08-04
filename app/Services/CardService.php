<?php

namespace App\Services;

use App\Http\Filters\{
    CardsByAttributeFilter,
    CardsByRaceFilter,
    CardsByTypesFilter
};
use App\Models\Card;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\{
	AllowedFilter,
	QueryBuilder
};

class CardService extends AbstractService
{
	protected $model = Card::class;

	/**
	 * Validates if the card respects the fusion monster rules.
	 * 
	 * @param array $fusionMaterials
	 * @throws \Exception
	 * @return array
	 */
	public static function fusionMaterialMonstersValidation(array $fusionMaterials): array
	{
		$fusionMaterials = array_map(function($item) {
			$card = Card::where('id', $item)->first();

			if (empty($card['attribute_id'])) throw new \Exception('please, type only monsters', 400);

			return [$card->name => $card->id];
		}, $fusionMaterials);

		$fusionMaterials = call_user_func_array(
			'array_merge', 
			$fusionMaterials
		);

		if (count($fusionMaterials) < 2)
			throw new \Exception('please, type at least 2 cards', 400);

		return $fusionMaterials;
	}

	public function index(Request $properties): LengthAwarePaginator
	{
		$payload = QueryBuilder::for(Card::class)
			->allowedIncludes([
				'attribute',
				'race',
				'types',
				'medias',
			])
			->allowedFilters([
				AllowedFilter::exact('id'),
				AllowedFilter::custom('type', new CardsByTypesFilter()),
				AllowedFilter::custom('attribute', new CardsByAttributeFilter()),
				AllowedFilter::custom('race', new CardsByRaceFilter()),
				'name',
				'description',
			])
			->allowedSorts([
				'name',
				'created_at'
			])
			->paginate()
			->appends($properties->query());

		return $payload;
	}

	public function store(array $properties): Card|null
	{
		$card = DB::transaction(function() use ($properties) {
			if ($properties['metadata']['fusion-material-monsters']) {
				$properties['metadata']['fusion-material-monsters'] = self::fusionMaterialMonstersValidation(
					$properties['metadata']['fusion-material-monsters']
				);
			}
	
			$card = Card::create($properties);
			$card->types()->attach($properties['types']);

			return $card;
		});

		return $card;
	}

	public function update(array $properties, int|Model $resource): Card|null
	{
		$resource = DB::transaction(function() use ($properties, $resource) {
			if ($properties['metadata']['fusion-material-monsters']) {
				$properties['metadata']['fusion-material-monsters'] = $this->fusionMaterialMonstersValidation(
					$properties['metadata']['fusion-material-monsters']
				);
			}
			
			$resource->update($properties);
			$resource->types()->sync($properties['types']);

			return $resource;
		});

		return $resource;
	}
}
