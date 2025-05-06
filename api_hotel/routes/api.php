<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuartosController;
use App\Http\Controllers\ReservasController;

//rotas para visualizar os registros
Route::get('/',function(){return response()->json(['Sucesso'=>true]);});
Route::get('/quartos',[QuartosController::class,'index']);
Route::get('/quartos/{codigo}',[QuartosController::class,'show']);

//rota para inserir os registros
Route::post('/quartos',[QuartosController::class,'store']);

//rota para alterar os registros
Route::put('/quartos/{codigo}',[QuartosController::class,'update']);

//rota para excluir o registro por id/codigo
Route::delete('/quartos/{id}',[QuartosController::class,'destroy']);


Route::get('/reservas',[ReservasController::class,'index']);
Route::get('/reservas/{codigo}',[ReservasController::class,'show']);

//rota para inserir os registros
Route::post('/reservas',[ReservasController::class,'store']);

//rota para alterar os registros
Route::put('/reservas/{codigo}',[ReservasController::class,'update']);

//rota para excluir o registro por id/codigo
Route::delete('/reservas/{id}',[ReservasController::class,'destroy']);