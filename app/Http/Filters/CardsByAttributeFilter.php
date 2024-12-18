<?php

namespace App\Http\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class CardsByAttributeFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property)
    {
        $query->whereHas('attribute', function(EloquentBuilder $query) use ($value) {
            $query->where('name', 'like', "%{$value}%");
        });
    }
}
