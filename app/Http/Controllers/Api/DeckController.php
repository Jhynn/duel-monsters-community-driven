<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeckRequest;
use App\Http\Requests\UpdateDeckRequest;
use App\Http\Resources\DeckResource;
use App\Models\Deck;
use App\Services\DeckService;
use App\Traits\ApiCommonResponses;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    use ApiCommonResponses;

    public function __construct(protected DeckService $service) { }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return DeckResource::collection($this->service->index($request));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeckRequest $request)
    {
        try {
            return DeckResource::make($this->service->store($request->validated()));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Deck $deck)
    {
        try {
            return DeckResource::make($this->service->show($deck, ['cards']));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeckRequest $request, Deck $deck)
    {
        try {
            return DeckResource::make($this->service->update($request->validated(), $deck));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deck $deck)
    {
        try {
            return DeckResource::make($this->service->destroy($deck));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
