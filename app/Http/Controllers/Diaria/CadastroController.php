<?php

namespace App\Http\Controllers\Diaria;

use App\Actions\Diaria\CriarDiaria;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiariaRequest;
use App\Http\Resources\Diaria;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Grava uma nova diaria no banco de dados
     * @param DiariaRequest $request
     * @param CriarDiaria $criarDiaria
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(DiariaRequest $request, CriarDiaria $criarDiaria)
    {
        $diaria = $criarDiaria->executar($request->all());

        return response(new Diaria($diaria), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
