<?php

namespace App\Services\ConsultaCEP;

interface ConsultaCEPInterface
{
    /**
     * Definir o padrão para busca de endereço a partir do CEP
     *
     * @param string $cep
     * @return false|EnderecoResponse
     */
    public function buscar(string $cep): false|EnderecoResponse;
}
