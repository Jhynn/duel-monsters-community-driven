<?php

namespace App\Providers;

use App\Models\{
    Attribute,
    Card,
    Type,
    User
};
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public static array $morphMap = [
        'card' => Card::class,
        'user' => User::class,
        'type' => Type::class,
        'attribute' => Attribute::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap(self::$morphMap);
    }
}
