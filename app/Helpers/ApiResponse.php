<?php
namespace App\Helpers;

class ApiResponse
{
    public static function success($statusCode = 200, $message = 'Success', $data = null)
    {
        return response()->json([
            'success' => true,
            'code' => $statusCode,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public static function error($statusCode = 400, $message = 'Error')
    {
        return response()->json([
            'success' => false,
            'code' => $statusCode,
            'message' => $message,
            'data' => null
        ], $statusCode);
    }
}