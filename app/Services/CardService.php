<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\{
	AllowedFilter,
	QueryBuilder
};

class CardService extends AbstractService
{
	protected $model = Card::class;

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
}
