<?php

namespace App\Traits;

use App\Helpers\ApiHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    use TransformResponse;

    /**
     * Crear respuesta de éxito.
     *
     * @param array|object $data
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    protected function successResponse(
        $data,
        string $message = ApiHelper::MSG_SUCCESSFUL_OPERATION,
        int $code = Response::HTTP_OK,
        array $extras = []
    ): JsonResponse
    {
        return $this->makeResponse($data, $message, $code, $extras);
    }


    /**
     * Crear respuesta para collecciones de eloquent.
     *
     * @param Collection $data
     * @return JsonResponse
     */
    protected function showAll(Collection $data): JsonResponse
    {
        if (!$data->isEmpty()) {
            $data = $this->transformCollection($data);
        }

        return $this->successResponse($data);
    }

    protected function showOne(?Model $instance): JsonResponse
    {
        if ($instance) {
            $instance = $this->transformInstance($instance);
        }

        return $this->successResponse($instance);
    }

    /**
     * Crear respuesta de error.
     *
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $code, array $extras = []): JsonResponse
    {
        return $this->makeResponse(NULL, $message, $code, $extras);
    }

    /**
     * Crear respuesta para mostrar mensajes.
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function showMessage(string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        return $this->makeResponse(NULL, $message, $code);
    }

    /**
     * Retorna en formato json la estructura de respuestas de la api.
     *
     * @param array|object|null $data
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    protected function makeResponse($data, string $message, int $code, array $extras = []): JsonResponse
    {
        $response = ApiHelper::makeResponse($data, $message, $code, $extras);

        return response()->json($response, $code);
    }
}
