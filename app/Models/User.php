<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Defini a relação com as cidades atendidas pelo(a) diarista
     */
    public function cidadesAtendidas()
    {
        return $this->belongsToMany(Cidade::class, 'cidade_diarista');
    }

    /**
     * Escopo que filtra as(os) diasristas
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDiarista(Builder $query): Builder
    {
        return $query->where('tipo_usuario', '=', 2);
    }

    /**
     * Escopo que filtra diaristas por código do IBGE
     *
     * @param Builder $query
     * @param integer $codigoIbge
     * @return Builder
     */
    public function scopeDiaristaAtendeCidade(Builder $query, int $codigoIbge): Builder
    {
        return
            $query->diarista()->whereHas('cidadesAtendidas', function ($q) use ($codigoIbge) {
                $q->where('codigo_ibge', '=', $codigoIbge);
            });
    }
}
