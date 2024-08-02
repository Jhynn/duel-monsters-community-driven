<?php

namespace App\Jobs;

use App\Models\Card;
use App\Models\Type;
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
            ->where('type_id', Type::where('name', 'Fusion Monster')->first()->id)
            ->get();

        foreach ($fusionMonsters as $fusionMonster) {
            $fusionMaterials = strstr($fusionMonster->description, "\n", true);

            if (empty($fusionMaterials))
                $fusionMaterials = $fusionMonster->description;

            $fusionMaterials = explode('+', $fusionMaterials);

            $fusionMaterials = array_map(function($item) {
                return preg_replace('/\W|\s/', '', $item);
            }, $fusionMaterials);
        }
    }
}
