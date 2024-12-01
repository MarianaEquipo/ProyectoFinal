<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\VideoController;


Route::get('/', [PrincipalController::class, 'index'])->name('index');

Route::get('/agregar', [PrincipalController::class, 'agregar'])->name('agregar');

Route::post('/guardar', [PrincipalController::class, 'guardar'])->name('guardar');

Route::delete('/borrar/{objeto}', [PrincipalController::class, 'borrar'])->name('borrar');

Route::get('/buscar', [PrincipalController::class, 'buscar'])->name('buscar');

Route::get('/editar/{objeto}', [PrincipalController::class, 'editar'])->name('editar');

Route::put('/actualizar/{objeto}', [PrincipalController::class, 'actualizar'])->name('actualizar');

Route::get('/ordenar/{tipo}', [PrincipalController::class, 'ordenar'])->name('ordenar');