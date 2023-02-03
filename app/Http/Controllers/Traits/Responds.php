<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

trait Responds
{
    /**
     * @param $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data, $status = 200): JsonResponse
    {
        return new JsonResponse($data, $status);
    }

    /**
     * @param mixed $message
     * @param array $errors
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(mixed $message, array $errors, int $status = 422): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }

    /**
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function created(mixed $data): JsonResponse
    {
        return new JsonResponse($data, 201);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deleted(string $message = ''): JsonResponse
    {
        return new JsonResponse($message, 201);
    }

    /**
     * Unauthorized request.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return new JsonResponse($message, 403);
    }

    /**
     * Bad request message.
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function badRequest($message = 'Bad Request')
    {
        return new JsonResponse($message, 400);
    }

    /**
     * Internal server error.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function serverError($message = '')
    {
        if (empty($message)) {
            $message = __('server.server_error');
        }

        return new JsonResponse($message, 500);
    }

    /**
     * Internal server error.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notFound($message = '')
    {
        if (empty($message)) {
            $message = __('server.not_found');
        }

        return new JsonResponse($message, 404);
    }
}
