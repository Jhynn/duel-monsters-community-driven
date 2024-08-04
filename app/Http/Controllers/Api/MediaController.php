<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use App\Providers\AppServiceProvider;
use App\Services\MediaService;
use App\Traits\ApiCommonResponses;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    use ApiCommonResponses;

    protected $storage;

    public function __construct(private MediaService $service) { }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return MediaResource::collection($this->service->index($request));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request)
    {
        try {
            $data = $request->validated();
            $data['request'] = $request;
            $data['mediable_id'] = $data['id'];
            $data['mediable_type'] = $data['type'];

            return MediaResource::make($this->service->store($data))
                ->Additional([
                    'message' => 'media succesfully stored',
                ]);
        } catch (\Throwable $e) {
            return $this->error($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        try {
            return MediaResource::make($this->service->show($media, ['card', 'type', 'race']));
        } catch (\Throwable $e) {
            return $this->error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        try {
            $data = $request->validated();
            $data['request'] = $request;
            $data['mediable_id'] = $data['id'];
            $data['mediable_type'] = $data['type'];

            return MediaResource::make($this->service->store($data))
                ->Additional([
                    'message' => 'media succesfully updated',
                ]);
        } catch (\Throwable $e) {
            return $this->error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        try {
            return MediaResource::make($this->service->destroy($media))
                ->Additional([
                    'message' => 'media succesfully deleted',
                ]);
        } catch (\Throwable $e) {
            return $this->error($e);
        }
    }

    public function types()
    {
        try {
            return $this->success(array_keys(AppServiceProvider::$morphMap));
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
