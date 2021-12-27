<?php

namespace App\Http\Hateoas;

use Illuminate\Database\Eloquent\Model;

class Index extends HateoasBase implements HateoasInterface
{
    /**
     * Retonar o links do hateoas para a rota inicial
     *
     * @return array
     */
    public function links(?Model $_ = null): array
    {
        $this->adicionarLink("GET", "diaristas_cidade", "diaristas.busca_por_cep");
        $this->adicionarLink("GET", "verificar_disponibilidade_atendimento", "enderecos.disponibilidade");
        $this->adicionarLink("GET", "endereco_cep", "enderecos.cep");
        $this->adicionarLink("GET", "listar_servicos", "servicos.index");

        $this->adicionarLink('POST', "cadastrar_usuario", "usuarios.create");
        $this->adicionarLink('POST', "login", 'autenticacao.login');
        $this->adicionarLink("GET", "usuario_logado", "usuarios.show");

        return $this->links;
    }
}
