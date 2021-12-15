<?php

namespace App\Rules;

use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class PrecoDiaria implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private Request $request)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $servico = Servico::find($this->request->servico);

        if (!$servico) {
            return false;
        }

        $total = 0;
        $total += $servico->valor_quarto * $this->request->quantidade_quartos;
        $total += $servico->valor_sala * $this->request->quantidade_salas;
        $total += $servico->valor_banheiro * $this->request->quantidade_banheiros;
        $total += $servico->valor_cozinha * $this->request->quantidade_cozinhas;
        $total += $servico->valor_quintal * $this->request->quantidade_quintais;
        $total += $servico->valor_outros * $this->request->quantidade_outros;

        return $total == $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O preço informado para a diária está incorreto para o tipo do Serviço.';
    }
}