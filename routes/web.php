<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::get('cliente',[ClienteController::class, 'cadastro'])
    ->name('tabela_orcamentos');

Route::get('cliente/criar',[ClienteController::class, 'create']);

Route::post('cliente/criar/',[ClienteController::class, 'store'])
    ->name('add_orcamento');

Route::delete('cliente/{id}',[ClienteController::class, 'destroy']);

Route::get('cliente/editar/{id}',[ClienteController::class, 'edit']);

Route::put('cliente/{id}/editar/',[ClienteController::class, 'editar']);
