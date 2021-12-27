<?php

namespace App\Http\Hateoas;

use Illuminate\Database\Eloquent\Model;

class Usuario extends HateoasBase implements HateoasInterface
{
    public function links(?Model $usario): array
    {
        if ($usario->tipo_usuario === 1) {
            $this->adicionarLink('POST', 'cadastrar_diaria', 'diarias.store');
        }

        return $this->links;
    }
}
