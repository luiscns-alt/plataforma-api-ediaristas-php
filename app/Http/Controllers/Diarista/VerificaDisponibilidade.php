<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Requests\CepRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Diarista\ObterDiaristasPorCEP;

class VerificaDisponibilidade extends Controller
{
    public function __construct(
        private ObterDiaristasPorCEP $obterDiaristasPorCEP
    ) {
    }

    /**
     *  Retorna a disponibilidade de diaristas para um CEP
     *
     * @param CepRequest $request
     * @return JsonResponse
     */
    public function __invoke(CepRequest $request): JsonResponse
    {
        [$diaristasCollection] = $this->obterDiaristasPorCEP->executar($request->cep);

        return resposta_padrao(
            "Disponibilidade verificada com sucesso",
            "sucesso",
            200,
            ["disponibilidade" => $diaristasCollection->isNotEmpty()]
        );
    }
}
