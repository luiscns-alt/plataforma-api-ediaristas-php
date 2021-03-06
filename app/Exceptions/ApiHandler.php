<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

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

        if ($e instanceof AuthenticationException) {
            return $this->authenticationException($e);
        }

        if ($e instanceof TokenBlacklistedException) {
            return $this->authenticationException($e);
        }

        if ($e instanceof AuthorizationException) {
            return $this->authorizationException($e);
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
        return resposta_padrao(
            "Erro de validação dos dados enviados",
            "Validation_Error",
            400,
            $e->errors()
        );
    }

    /**
     * Retorna uma resposta para o erro de autenticação
     *
     * @param AuthenticationException $e
     * @return JsonResponse
     */
    protected function authenticationException(
        AuthenticationException|TokenBlacklistedException $e
    ): JsonResponse {
        return resposta_padrao(
            $e->getMessage(),
            'token_not_valid',
            401
        );
    }

    /**
     * Retorna uma resposta para o erro de autorização
     *
     * @param AuthorizationException $e
     * @return JsonResponse
     */
    protected function authorizationException(AuthorizationException $e): JsonResponse
    {
        return resposta_padrao(
            $e->getMessage(),
            'autorization_error',
            401
        );
    }

    /**
     * Retorna uma resposta para erro genérico
     *
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function genericException(\Throwable $e): JsonResponse
    {
        return resposta_padrao(
            "Erro Interno no Servidor",
            "Internal_Error",
            500
        );
    }
}
