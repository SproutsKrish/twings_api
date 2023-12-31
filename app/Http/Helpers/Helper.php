<?php

namespace App\Http\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;

class Helper
{
    public static function sendError($message, $errors = [], $code = 401)
    {
        $response = ['success' => false, 'message' => $message, 'status_code' => $code];
        if (!empty($errors)) {
            $response['data']  = $errors;
        }
        throw new HttpResponseException(response()->json($response, $code));
    }

    public static function sendSuccess($message, $code = 200)
    {
        $response = ['success' => true, 'message' => $message, 'status_code' => $code];
        throw new HttpResponseException(response()->json($response, $code));
    }
}
