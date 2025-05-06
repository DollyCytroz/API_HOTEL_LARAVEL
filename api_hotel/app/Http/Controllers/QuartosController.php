<?php

namespace App\Http\Controllers;

use App\Models\Quartos;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class QuartosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = Quartos::all();
    
        // Contando o número de registros
        $contador = $registros->count();
    
        // Verificando se há registros
        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Quartos encontrados com sucesso!',
                'data' => $registros,
                'total' => $contador
            ], 200); // Retorna HTTP 200 (OK) com os dados e a contagem
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum quarto encontrado.',
            ], 404); // Retorna HTTP 404 (Not Found) se não houver registros
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validação dos dados recebidos
    $validator = Validator::make($request->all(), [
        'numero' => 'required',
        'tipo' => 'required',
        'preco_diaria' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Registros inválidos',
            'errors' => $validator->errors()
        ], 400); // Retorna HTTP 400 (Bad Request) se houver erro de validação
    }

    $registros = Quartos::create($request->all());

    if ($registros) {
        return response()->json([
            'success' => true,
            'message' => 'Quarto cadastrado com sucesso!',
            'data' => $registros
        ], 201); 
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Erro ao cadastrar o quarto'
        ], 500); // Retorna HTTP 500 (Internal Server Error) se o cadastro falhar
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Buscando a criptomoeda pelo ID
        $registros = Quartos::find($id);
    
        // Verificando se a criptomoeda foi encontrada
        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'Quarto localizado com sucesso!',
                'data' => $registros
            ], 200); // Retorna HTTP 200 (OK) com os dados da criptomoeda
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Quarto não localizada.',
            ], 404); // Retorna HTTP 404 (Not Found) se a criptomoeda não for encontrada
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validator = Validator::make($request->all(), [
        'numero' => 'required',
        'tipo' => 'required',
        'preco_diaria' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Registros inválidos',
            'errors' => $validator->errors()
        ], 400); // Retorna HTTP 400 se houver erro de validação
    }

    // Encontrando a criptomoeda no banco
    $registrosBanco = Quartos::find($id);

    if (!$registrosBanco) {
        return response()->json([
            'success' => false,
            'message' => 'Quarto não encontrado'
        ], 404); 
    }

    // Atualizando os dados
    $registrosBanco->numero = $request->numero;
    $registrosBanco->tipo = $request->tipo;
    $registrosBanco->preco_diaria = $request->preco_diaria;

    // Salvando as alterações
    if ($registrosBanco->save()) {
        return response()->json([
            'success' => true,
            'message' => 'Quarto atualizado com sucesso!',
            'data' => $registrosBanco
        ], 200); // Retorna HTTP 200 se a atualização for bem-sucedida
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Erro ao atualizar o quarto'
        ], 500); // Retorna HTTP 500 se houver erro ao salvar
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
   
    $registros = Quartos::find($id);

    if (!$registros) {
        return response()->json([
            'success' => false,
            'message' => 'Quarto não encontrado'
        ], 404); // Retorna HTTP 404 se não for encontrado
    }

    // Deletando 
    if ($registros->delete()) {
        return response()->json([
            'success' => true,
            'message' => 'Quarto deletado com sucesso'
        ], 200); // Retorna HTTP 200 se a exclusão for bem-sucedida
    }

    return response()->json([
        'success' => false,
        'message' => 'Erro ao deletar o quartos'
    ], 500); // Retorna HTTP 500 se houver erro na exclusão
}
}