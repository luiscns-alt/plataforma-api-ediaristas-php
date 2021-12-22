<?php

namespace App\Actions\Diaria;

use App\Models\Diaria;
use App\Models\Servico;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CriarDiaria
{
    /**
     * Cria a diária no banco de dados
     *
     * @param array $dados
     * @return void
     */
    public function executar(array $dados)
    {
        Gate::authorize('tipo-cliente');

        $dados['status'] = 1;
        $dados['servico_id'] = $dados['servico'];
        $dados['valor_comissao'] = $this->calcularComissao($dados);
        $dados['cliente_id'] = Auth::user()->id;

        return Diaria::create($dados);
    }

    /**
     * Calcular o valor da comissão da plataforma
     *
     * @param array $dados
     * @return float
     */
    private function calcularComissao(array $dados): float
    {
        $servico = Servico::find($dados['servico_id']);

        $porcentagem = $servico->porcentagem / 100;

        return $dados['preco'] * $porcentagem;
    }
}
