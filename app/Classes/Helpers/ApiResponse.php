<?php

namespace App\Classes\Helpers;


use Illuminate\Http\Response;

class ApiResponse
{

    public static function goodResponse($response=[])
    {
        return response()->json(
            [
                'response' => [
                    'code' => Response::HTTP_OK,
                    'status' => Response::$statusTexts[Response::HTTP_OK]
                ],
                'data' => $response
            ],
            Response::HTTP_OK,
            ['Content-Type' => 'application/json'],
            JSON_UNESCAPED_UNICODE);
    }

    public static function goodResponseSimple($response)
    {
        return response()->json(
            $response,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json'],
            JSON_UNESCAPED_UNICODE);
    }

    public static function badResponse($response, $statusCode = 500)
    {
        return response()->json(
            [
                'response' => [
                    'code' => $statusCode,
                    'status' => Response::$statusTexts[$statusCode]
                ],
                'data' => $response
            ],
            $statusCode,
            ['Content-Type' => 'application/json'],
            JSON_UNESCAPED_UNICODE);
    }

    public static function badResponseSimple($response, $statusCode = 500)
    {
        return response()->json(
            $response,
            $statusCode,
            ['Content-Type' => 'application/json'],
            JSON_UNESCAPED_UNICODE);
    }

    public static function badResponseValidation($response)
    {
        return response()->json(
            [
                'response' => [
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'status' => Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY]
                ],
                'data' => $response
            ],
            Response::HTTP_UNPROCESSABLE_ENTITY,
            ['Content-Type' => 'application/json'],
            JSON_UNESCAPED_UNICODE);
    }
}