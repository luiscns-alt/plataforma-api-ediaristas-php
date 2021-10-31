<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Diarista\ObtemDiaristasPorCEP;
use App\Http\Controllers\Diarista\VerificaDisponibilidade;
use App\Http\Controllers\Endereco\BuscaCepApiExterna;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Servico\ObtemServicos;

Route::get('/',IndexController::class);

Route::get('/diaristas/localidades', ObtemDiaristasPorCEP::class)->name('diaristas.busca_por_cep');
Route::get('/diaristas/disponibilidade', VerificaDisponibilidade::class)->name('enderecos.disponibilidade');
Route::get('/enderecos', BuscaCepApiExterna::class)->name('enderecos.cep');
Route::get('/servicos', ObtemServicos::class)->name('servicos.index');
