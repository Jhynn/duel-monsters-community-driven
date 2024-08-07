<?php

namespace App\Services;

use App\Http\Filters\{
    CardsByAttackFilter,
    CardsByAttributeFilter,
    CardsByDefenseFilter,
    CardsByLevelFilter,
    CardsByRaceFilter,
	CardsByTypesFilter
};
use App\Models\{
	Attribute,
	Card
};
use Illuminate\Contracts\Database\Eloquent\Builder;
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
	public static function fusionMaterialMonstersValidation(array &$fusionMaterials): array
	{
		$fusionMaterials = Card::whereIn('id', array_keys($fusionMaterials))
			->get()
			->map(function ($card) use ($fusionMaterials) {
				$nonMonsters = Attribute::whereIn('name', ['trap', 'spell'])
					->get('id')
					->pluck('id')
					->toArray();

				if (in_array($card->attribute_id, $nonMonsters)) throw new \Exception('please, type only monsters', 400);

				return [
					'id' => $card->id,
					'name' => $card->name,
					'quantity' => $fusionMaterials[$card->id],
				];
			});

		$qty = $fusionMaterials->reduce(function($acc, $item) {
			return $acc + $item['quantity'];
		}, 0);

		if ($qty < 2) throw new \Exception('please, type at least 2 cards', 400);

		return $fusionMaterials->toArray();
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
				AllowedFilter::custom('attack', new CardsByAttackFilter()),
				AllowedFilter::custom('defense', new CardsByDefenseFilter()),
				AllowedFilter::custom('level', new CardsByLevelFilter()),
				'name',
				'description',
			])
			->allowedSorts([
				'name',
				'attack',
				'defense',
				'level',
				'created_at'
			])
			->paginate()
			->appends($properties->query());

		return $payload;
	}

	public function store(array $properties): Card|null
	{
		$card = DB::transaction(function () use ($properties) {
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
		$resource = DB::transaction(function () use ($properties, $resource) {
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

	public static function fusionMaterialMonsters(): void
	{
		Card::whereHas('types', function (Builder $query) {
			$query->where('name', 'Fusion Monster');
		})
			->get()
			->map(function (Card $fusionMonster) {
				$names = strstr($fusionMonster->description, "\n", true);

				if (empty($names)) $names = $fusionMonster->description;

				$fusionMaterials = explode('+', preg_replace('/"/i', '', $names));
				$tmp = [];

				foreach ($fusionMaterials as $fusionMaterial)
					$tmp[] = Card::where('name', trim($fusionMaterial))->first()->id;

				$tmp = self::itemQuantity($tmp);

				$fusionMaterials = CardService::fusionMaterialMonstersValidation($tmp);

				$fusionMonster->update([
					'metadata' => [
						'fusion-material-monsters' => $fusionMaterials,
					],
				]);
			});
	}

	private static function itemQuantity(array $items): array
	{
		$tmp = [];

		foreach ($items as $item) {
			$tmp[$item] = isset($tmp[$item]) ? ++$tmp[$item] : 1;
		}

		return $tmp;
	}
}
