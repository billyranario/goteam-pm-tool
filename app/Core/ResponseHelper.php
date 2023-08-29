<?php

namespace App\Core;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ResponseHelper
{

    /**
     * Returns json data with status code.
     * If status code is not provided, default status code is 200.
     * @param string|array|object $response
     * @param int $status
     * @return JsonResponse
     */
    public static function json($response, int $status = SymfonyResponse::HTTP_OK): JsonResponse
    {
        return response()->json($response, $status);
    }

    /**
     * Returns 200 status code.
     * Can be used for webhook response.
     * @return JsonResponse
     */
    public static function ok(): JsonResponse
    {
        return response()->json([], SymfonyResponse::HTTP_OK);
    }

    /**
     * Returns an empty object with 200 status code.
     * @return JsonResponse
     */
    public static function empty(): JsonResponse
    {
        return response()->json(null, SymfonyResponse::HTTP_OK);
    }

    /**
     * Returns an empty object or resource with 200 status code.
     *
     * @param string $resource
     * @param $data
     * @return JsonResponse|JsonResource
     */
    public static function resource(string $resource, $data)
    {
        $response = self::empty();

        if ($data instanceof Model && method_exists($data, "isPresent") && $data->isPresent()) {
            $response = new $resource($data);
        } elseif ($data instanceof Model && !empty($data->id)) {
            $response = new $resource($data);
        } elseif (is_array($data) && !empty($data)) {
            $response = new $resource((object) $data);
        } elseif ($data instanceof LengthAwarePaginator || $data instanceof Collection) {
            $response = $resource::collection($data);
        }

        return $response;
    }

    /**
     * Returns a success message with 200 status code.
     * @param string $message
     * @param string $key
     * @return JsonResponse
     */
    public static function success(string $message, string $key = 'success'): JsonResponse
    {
        return response()->json([$key => $message], SymfonyResponse::HTTP_OK);
    }

    /**
     * Returns an error message with 400(Bad Request) status code.
     * @param string $message
     * @param int $errorCode
     * @param string $key
     * @return JsonResponse
     */
    public static function error(string $message, int $errorCode = SymfonyResponse::HTTP_BAD_REQUEST, string $key = 'error'): JsonResponse
    {
        return response()->json([$key => $message], $errorCode);
    }

    /**
     * Returns an error message with 401(Unauthorized) status code.
     * @param string $message
     * @return JsonResponse
     */
    public static function unauthorized(string $message = 'Unauthorized.'): JsonResponse
    {
        return response()->json(['error' => $message], SymfonyResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Returns an error message with 401(Unauthorized) status code.
     * @param string $message
     * @return JsonResponse
     */
    public static function notFound(string $message = 'The requested resource could not be found.'): JsonResponse
    {
        return response()->json(['error' => $message], SymfonyResponse::HTTP_NOT_FOUND);
    }
}
