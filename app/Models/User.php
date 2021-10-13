<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
     *
     * @return BelongsToMany
     */
    public function cidadesAtendidas(): BelongsToMany
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
        return $query->where('tipo_usuario', 2);
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
                $q->where('codigo_ibge', $codigoIbge);
            });
    }

    /**
     * Busca 6 diaristas por código do ibge
     *
     * @param integer $codigoIbge
     * @return Collection
     */
    static public function diaristaDisponivelCidade(int $codigoIbge): Collection
    {
        return User::diaristaAtendeCidade($codigoIbge)->limit(6)->get();
    }

    /**
     * Busaca a quantidade de diaristas por código do ibge
     *
     * @param integer $codigoIbge
     * @return void
     */
    static public function diaristasDisponivelCidadeTotal(int $codigoIbge): int
    {
        return User::diaristaAtendeCidade($codigoIbge)->count();
    }
}
