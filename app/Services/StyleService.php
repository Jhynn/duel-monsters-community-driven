<?php

namespace App\Services;

use App\Models\{
	Style,
    User
};

class StyleService extends AbstractService
{
	protected $model = Style::class;

	public function store(array $properties): \Illuminate\Database\Eloquent\Model|null
	{
		/** @var User */
		$user = auth()->user();
		$style = $user->styles()->create([$properties]);

		return $style;
	}
}
