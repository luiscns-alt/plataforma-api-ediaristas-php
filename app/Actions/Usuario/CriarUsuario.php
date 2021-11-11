<?php

namespace App\Actions\Usuario;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class CriarUsuario
{
    /**
     * Cadastra um usuario no banco de dados
     *
     * @param array $dados
     * @param UploadedFile $foto_documento
     * @return User
     */
    public function executar(array $dados, UploadedFile $fotoDocumento): User
    {
        $dados['foto_documento'] = $fotoDocumento->store('local');

        $dados['password'] = Hash::make($dados['password']);

        return User::create($dados);
    }
}
