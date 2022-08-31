<?php

if (!function_exists('response_ok')) {
    function response_ok($message = "", $headers = [],) {
        return response()->json(
            [
                "status" => true,
                "message" => $message,
            ],
            200,
            $headers
        );
    }
}

if (!function_exists('response_ok_with_data')) {
    function response_ok_with_data($data = [], $message = "", $headers = [],) {
        return response()->json(
            [
                "data" => $data,
                "status" => true,
                "message" => $message,
            ],
            200,
            $headers
        );
    }
}

if (!function_exists('response_unauthenticated')) {
    function response_unauthenticated($error = "Unauthenticated.", $headers = [],) {
        return response()->json(
            [
                "status" => false,
                "error" => $error,
            ],
            401,
            $headers
        );
    }
}

if (!function_exists('response_unauthorized')) {
    function response_unauthorized($error = "Unauthorized.", $headers = [],) {
        return response()->json(
            [
                "status" => false,
                "error" => $error,
            ],
            403,
            $headers
        );
    }
}

if (!function_exists('response_not_found')) {
    function response_not_found($error = "Not Found.", $headers = [],) {
        return response()->json(
            [
                "status" => false,
                "error" => $error,
            ],
            404,
            $headers
        );
    }
}

if (!function_exists('response_created')) {
    function response_created($data = [], $message = "", $headers = [],) {
        return response()->json(
            [
                "status" => true,
                "data" => $data,
                "message" => $message,
            ],
            201,
            $headers
        );
    }
}

if (!function_exists('response_validation')) {
    function response_validation($errors = [], $headers = [],) {
        return response()->json(
            [
                "status" => false,
                "errors" => $errors,
            ],
            422,
            $headers
        );
    }
}

if (!function_exists('response_error')) {
    function response_error($error = "", $headers = [],) {
        return response()->json(
            [
                "status" => false,
                "error" => $error,
            ],
            400,
            $headers
        );
    }
}