<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DiaristaPublicoCollection extends ResourceCollection
{
    public static $wrap = 'diaristas';

    private int $quantidadeDiaristas;

    /**
     * Guarda a quantidade de diaristas -6
     *
     * @param [type] $resource
     * @param integer $quantidadeDiaristas
     */
    public function __construct($resource, int $quantidadeDiaristas)
    {
        parent::__construct($resource);

        $this->quantidadeDiaristas = $quantidadeDiaristas - 6;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'diaristas' => DiaristaPublico::collection($this->collection),
            'quantidade_diaristas' => $this->quantidadeDiaristas > 0 ? $this->quantidadeDiaristas : 0
        ];
    }
}
