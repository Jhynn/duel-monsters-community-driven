<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class CardsByDefenseFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property)
    {
        $op = preg_replace('/\d/i', '', $value);
        $value = preg_replace('/\D/i', '', $value);

        if (empty($op)) $op = '<=';

        $query->where('defense', $op, $value);
    }
}
