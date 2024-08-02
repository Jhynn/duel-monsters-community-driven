<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;
use App\Services\CardService;
use App\Traits\ApiCommonResponses;
use Illuminate\Http\Request;

class CardController extends Controller
{
	use ApiCommonResponses;

    public function __construct(private CardService $service) { }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return CardResource::collection($this->service->index($request));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        //
    }
}
