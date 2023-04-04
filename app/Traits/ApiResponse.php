<?php
namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse{

    protected function successResponse($data, $code = 200, $message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'=> true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($code, $message = null, $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }

}
