<?php

namespace App\Jobs;

use App\Models\Card;
use App\Models\Type;
use App\Services\CardService;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FusionMaterialMonsters implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Card $cards) { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fusionMonsters = $this->cards
            ->whereHas('types', function(Builder $query) {
                $query->where('name', 'Fusion Monster');
            })
            ->get();

        foreach ($fusionMonsters as $fusionMonster) {
            $names = strstr($fusionMonster->description, "\n", true);

            if (empty($names)) $names = $fusionMonster->description;

            $fusionMaterials = explode('+', preg_replace('/"/i', '', $names));
            $tmp = [];

            foreach ($fusionMaterials as $fusionMaterial) {
                $tmp[] = Card::where('name', trim($fusionMaterial))->first()->id;
            }

            $fusionMaterials = CardService::fusionMaterialMonstersValidation(
                $tmp
            );

            // "Indirect modification of overloaded element of App\\Models\\Card has no effect"
            $fusionMonster['metadata']['fusion-material-monsters'] = $fusionMaterials;
            $fusionMonster->save();
        }
    }
}
