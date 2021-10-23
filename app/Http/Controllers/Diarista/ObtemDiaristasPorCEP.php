<?php

namespace App\Http\Controllers\Diarista;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiaristaPublicoCollection;
use App\Services\ConsultaCEP\ConsultaCEPInterface;


class ObtemDiaristasPorCEP extends Controller
{
    /**
     * Busca diaristas pelo CEP
     *
     * @param Request $request
     * @param ConsultaCEPInterface $servicoCEP
     * @return DiaristaPublicoCollection|JsonResponse
     */
    public function __invoke(Request $request,  ConsultaCEPInterface $servicoCEP): DiaristaPublicoCollection|JsonResponse
    {
        $request->validate([
            'cep' => ['required', 'numeric']
        ]);

        $dados = $servicoCEP->buscar($request->cep);

        if ($dados === false) {
            return response()->json(['erro' => 'CEP Inválido'], 400);
        }

        return new DiaristaPublicoCollection(
            User::diaristaDisponivelCidade($dados->ibge),
            User::diaristasDisponivelCidadeTotal($dados->ibge)
        );
    }
}
