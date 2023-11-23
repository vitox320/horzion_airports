<?php

namespace App\Traits;

trait Response
{
    protected function apiResponse(array $data, int $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        $header = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        ];

        return response()->json($data, $statusCode, $header, JSON_UNESCAPED_UNICODE);

    }

}
