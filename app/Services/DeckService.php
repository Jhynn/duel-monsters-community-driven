<?php

namespace App\Services;

use App\Models\{
    Card,
    Deck
};
use Exception;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\{
    AllowedFilter,
    QueryBuilder
};
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeckService extends AbstractService
{
	protected $model = Deck::class;

	private function cards(Deck $deck, array $cards): void
	{
		if (isset($cards['main'])) {
			DB::table('card_deck')
				->where('deck_id', $deck->getKey())
				->where('deck', 'main')
				->delete();

			for ($i=0; $i < count($cards['main']); $i++)
				$deck->cards()->attach($cards['main'][$i], [
					'deck' => 'main',
				]);
		}

		if (isset($cards['fusion'])) {
			DB::table('card_deck')
				->where('deck_id', $deck->getKey())
				->where('deck', 'fusion')
				->delete();

			for ($i=0; $i < count($cards['fusion']); $i++)
				$deck->cards()->attach($cards['fusion'][$i], [
					'deck' => 'fusion',
				]);
		}

		if (isset($cards['additional'])) {
			DB::table('card_deck')
				->where('deck_id', $deck->getKey())
				->where('deck', 'additional')
				->delete();

			for ($i=0; $i < count($cards['additional']); $i++)
				$deck->cards()->attach($cards['additional'][$i], [
					'deck' => 'additional',
				]);
		}
	}

	private function cardMaxQuantity(array $cards): void
	{
		$cards = array_merge(...array_values($cards));
		$uniques = array_unique($cards);

		foreach ($uniques as $key) {
			$card = Card::findOr($key, fn() => throw new Exception('please, type an existing card', 400));

			$qty = count(array_intersect($cards, [$card->id]));

			if ($qty > $card->max_quantity)
				throw new Exception("you only can have {$card->max_quantity} \"{$card->name}\", but you've put {$qty} in your deck.", 400);
		}
	}

	public function index(Request $properties): LengthAwarePaginator
	{
		$payload = QueryBuilder::for(Deck::class)
			->allowedIncludes([
				'cards',
			])
			->allowedFilters([
				AllowedFilter::exact('id'),
				'name',
				'description',
			])
			->allowedSorts([
				'name',
				'created_at',
				'updated_at',
			])
			->defaultSort('-updated_at')
			->paginate()
			->appends($properties->query());

		return $payload;
	}

	public function store(array $properties): Deck|null
	{
		$this->cardMaxQuantity($properties['cards']);
		$deck = Deck::create($properties);
		$this->cards($deck, $properties['cards']);

		return $deck;
	}

	public function update(array $properties, int|Model $resource): Model|null
	{
		$this->cardMaxQuantity($properties['cards']);
		/** @var Deck */
		$resource = $this->show($resource);
		$resource->update($properties);
		$this->cards($resource, $properties['cards']);

		return $resource;
	}

	public function destroy(int|Model $resource, array $aux = null): Model|null
	{
		DB::table('card_deck')
			->where('deck_id', $resource->getKey())
			->delete();

		$resource->delete();

		return $resource;
	}
}
