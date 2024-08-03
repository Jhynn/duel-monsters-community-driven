<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\{
    DestroyCardRequest,
    StoreCardRequest,
    UpdateCardRequest
};
use App\Http\Resources\CardResource;
use App\Models\Card;
use App\Services\CardService;
use App\Traits\ApiCommonResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {
            $data = $request->validated();

            $payload = DB::transaction(function () use ($data) {
                return $this->service->store($data);
            });

            return CardResource::make($payload)
                ->additional([
                    'message' => 'card succesfully created',
                ]);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        try {
            return CardResource::make($this->service->show($card, ['attribute', 'types', 'race', 'medias']));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        try {
            $data = $request->validated();

            $payload = DB::transaction(function () use ($data, $card) {
                return $this->service->update($data, $card);
            });

            return CardResource::make($payload)
                ->additional([
                    'message' => 'card succesfully updated',
                ]);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyCardRequest $request, $card)
    {
        try {
            $payload = DB::transaction(function () use ($card) {
                return $this->service->destroy($card);
            });

            return CardResource::make($payload)
                ->additional([
                    'message' => 'card succesfully deleted',
                ]);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
