<?php

namespace App\Jobs;

use App\Models\Card;
use App\Services\CardService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FusionMaterialMonsters implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Card $cards)
    {
        $this->onQueue('cards');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        CardService::fusionMaterialMonsters();
    }
}
