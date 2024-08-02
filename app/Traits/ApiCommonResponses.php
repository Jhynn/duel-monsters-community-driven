<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

trait ApiCommonResponses
{
    public function success(array $data, ?array $additional = null, $responseCode = 200): JsonResponse
    {
        if ($data && $additional) {
            return response()->json(array_merge([
                'data' => $data,
            ], $additional), $responseCode);
        } elseif ($additional) {
            return response()->json($additional, $responseCode);
        }

        return response()->json([
            'data' => $data,
        ], $responseCode);
    }

    public function error(Exception|Throwable $e): JsonResponse
    {
        $statusCode = 500;

        if (method_exists($e, 'getStatusCode')) {
            $statusCode = $e->getStatusCode();
        }

        report($e);

        return response()->json([
            'message' => $e->getMessage(),
        ], $statusCode);
    }
}
