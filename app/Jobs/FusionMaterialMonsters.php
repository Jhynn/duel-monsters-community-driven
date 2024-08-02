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

            $names = array_map(function ($item) {
                return trim(preg_replace('/"(.*)"/i', '$1', $item));
            }, $fusionMaterials);

            $fusionMaterials = [];

            foreach($names as $name)
                $fusionMaterials[] = Card::select(['id', 'name'])->where('name', $name)->first();

            $fusionMonster['metadata']['fusion-materials-monsters'] = $fusionMaterials;
            $fusionMonster->save();
        }
    }
}
