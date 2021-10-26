<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;


trait ApiHandler
{
    /**
     * Trata as excecões da nossa API
     *
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function getJsonException(\Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return $this->validationException($e);
        }

        return $this->genericException($e);
    }

    /**
     * Retornar uma resposta para erro de validação
     *
     * @param ValidationException $e
     * @return JsonResponse
     */
    protected function validationException(ValidationException $e): JsonResponse
    {
        return response()->json([
            "status" => 400,
            "code" => "Validation_Error",
            "message" => "Erro de validaaçõa dos dados enviados"
        ] + $e->errors(), 400);
    }

    /**
     * Retorna uma resposta para erro genérico
     *
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function genericException(\Throwable $e): JsonResponse
    {
        return response()->json([
            "status" => 500,
            "code" => "Internal_Error",
            "message" => "Erro Interno no Servidor"
        ], 500);
    }
}
