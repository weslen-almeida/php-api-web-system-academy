<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function all(): JsonResponse
    {
       try {
           $users = User::get();

           return response()->json(
               [
                   'status' => true,
                   'users' => $users,
               ], Response::HTTP_CREATED
           );
       } catch(Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Erro ao listar os usuarios'
                ], Response::HTTP_BAD_REQUEST
            );
       }
    }

    public function create(Request $request): JsonResponse
    {
       try {
           // Validar email e senha
        // Criar a service e repository e colocar as regras nos lugares certos
           if(Auth::attempt(['email' => $request->email, 'password' =>$request->password])){

                return response()->json(
                    [
                        'status' => true,
                        'message' => 'suario criado com sucesso',
                    ], Response::HTTP_CREATED
                );
            }

            return response()->json(
                [
                    'status' => false,
                    'message' => 'Erro ao criar usuario',
                ], Response::HTTP_BAD_REQUEST
            );

       } catch(Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Erro ao criar usuario, tente novamente'
                ], Response::HTTP_BAD_REQUEST
            );
       }
    }
}
