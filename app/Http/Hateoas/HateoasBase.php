<?php

namespace App\Http\Hateoas;

class HateoasBase
{
    /**
     * Links do Hateoas
     *
     * @var array
     */
    protected array $links = [];

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
