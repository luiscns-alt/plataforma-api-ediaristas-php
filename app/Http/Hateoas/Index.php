<?php

namespace App\Http\Hateoas;

class Index
{
    /**
     * Links do Hateoas
     *
     * @var array
     */
    protected array $links = [];

    /**
     * Retonar o links do hateoas para a rota inicial
     *
     * @return array
     */
    public function links(): array
    {
        $this->adicionarLink("GET", "diaristas_cidade", "diaristas.busca_por_cep");
        $this->adicionarLink("GET", "verificar_disponibilidade_atendimento", "enderecos.disponibilidade");
        $this->adicionarLink("GET", "endereco_cep", "enderecos.cep");
        $this->adicionarLink("GET", "listar_servicos", "servicos.index");

        return $this->links;
    }

    /**
     * Adiciona um link no Hateoas
     *
     * @param string $metodo
     * @param string $descricao
     * @param string $nomeRota
     * @param array $parametrosRotas
     * @return void
     */
    protected function adicionarLink(
        string $metodo,
        string $descricao,
        string $nomeRota,
        array $parametrosRotas = []
    ) {
        $this->links[] = [
            "type" => $metodo,
            "rel" => $descricao,
            "uri" => route($nomeRota, $parametrosRotas),
        ];
    }
}
