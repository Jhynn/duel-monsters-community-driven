<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeckRequest;
use App\Http\Requests\StoreStyleRequest;
use App\Http\Requests\UpdateDeckRequest;
use App\Http\Requests\UpdateStyleRequest;
use App\Http\Resources\StyleResource;
use App\Models\Deck;
use App\Services\StyleService;
use App\Traits\ApiCommonResponses;
use Illuminate\Http\Request;

class StyleController extends Controller
{
    use ApiCommonResponses;

    public function __construct(protected StyleService $service) { }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return StyleResource::collection($this->service->index($request));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStyleRequest $request)
    {
        try {
            return StyleResource::make($this->service->store($request->validated()));
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
            return StyleResource::make($this->service->show($deck));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStyleRequest $request, Deck $deck)
    {
        try {
            return StyleResource::make($this->service->update($request->validated(), $deck));
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
            return StyleResource::make($this->service->destroy($deck));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
