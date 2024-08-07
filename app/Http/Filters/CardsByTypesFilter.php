<?php

namespace App\Http\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class CardsByTypesFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property)
    {
        $query->whereHas('types', function(EloquentBuilder $query) use ($value) {
            if ((gettype($value) == 'array')) {
                $query->where('name', 'like', "%{$value[0]}%");
                
                foreach (array_slice($value, 1) as $type) {
                    $type = trim($type);
                    $query->orWhere('name', 'like', "%{$type}%");
                }
            } else
                $query->where('name', 'like', "%{$value}%");
        });
    }
}