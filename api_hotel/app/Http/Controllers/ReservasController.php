<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = Reservas::All();

        $contador = $registros->count();

        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Reserva encontrada com sucesso!',
                'data' => $registros,
                'total' => $contador
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhuma reserva encontrada'
            ], 404);  
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome_hospede' => 'required',
            'data_checkin' => 'required',
            'data_checkout' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar reserva',
                'data' => $validator->errors()
            ], 400);
        }

        $registros = Reservas::create($request->all());

        if($registros) {
            return response()->json([
                'success' => true,
                'message' => 'Reservas cadastrado com sucesso!',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar reserva'
            ], 500); 
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $registros = Reservas::find($id);

        if($registros){
            return response()->json([
                'success' => true,
                'message' => 'Reserva encontrada com sucesso!',
                'data' => $registros
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Reserva não encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nome_hospede' => 'required',
            'data_checkin' => 'required',
            'data_checkout' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar reserva',
                'data' => $validator->errors()
            ], 400);
        }

        $registrosBanco = Reservas::find($id);

        if (!$registrosBanco) {
            return response()->json([
                'success' => false,
                'message' => 'Reserva não encontrado'
            ], 404);
        }

        $registrosBanco->nome_hospede= $request->nome_hospede;
        $registrosBanco->data_checkin= $request->data_checkin;
        $registrosBanco->data_checkout= $request->data_checkout;

        if ($registrosBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Reserva atualizada com sucesso!',
                'data' => $registrosBanco
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar reserva'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registros = Reservas::find($id);

        if(!$registros) {
            return response()->json([
                'success' => false,
                'message' => 'Reserva não encontrada'
            ], 404);
        } 

        if ($registros->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Reserva excluída com sucesso!'
            ], 200);
        } 

        return response()->json([
            'success' => false,
            'message' => 'Erro ao excluir reserva'
        ], 500);
    }
}
