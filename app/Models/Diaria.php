<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diaria extends Model
{
    use HasFactory;

    /**
     * Campos bloqueados na definição de dados em massa.
     */
    protected $guarded = ['motivo_cancelamento', 'created_at', 'updated_at'];

    /**
     * Define a relação de servico
     *
     * @return BelongsTo
     */
    public function servico(): BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }

    /**
     * Define a relação de cliente
     *
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    /**
     * Define o status da diaria como pago
     *
     * @return boolean
     */
    public function pagar(): bool
    {
        $this->status = 2;
        return $this->save();
    }
}
