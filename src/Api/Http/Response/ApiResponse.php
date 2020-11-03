<?php

declare(strict_types=1);

namespace Api\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ApiResponse
{
    public static function error(string $message, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse([
            'status' => $statusCode,
            'message' => $message,
        ]);
    }
}
