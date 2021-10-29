<?php

namespace App\Http\Controllers\Endereco;

use App\Http\Controllers\Controller;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BuscaCepApiExterna extends Controller
{
    public function __construct(
        private ConsultaCEPInterface $consultaCep
    ) {
    }

    /**
     * Retorna os dados de endereço a parti do cep
     *
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array
    {
        $request->validate([
            'cep' => ['required', 'numeric']
        ]);

        $dadosEndereco = $this->consultaCep->buscar($request->cep);

        if ($dadosEndereco === false) {
            throw ValidationException::withMessages(['cep' => 'CEP não encontrado']);
        }

        return (array) $dadosEndereco;
    }
}
