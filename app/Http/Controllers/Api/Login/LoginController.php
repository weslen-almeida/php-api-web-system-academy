<?php

namespace App\Http\Controllers\Api\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        try {
            // Validar email e senha
            if(Auth::attempt(['email' => $request->email, 'password' =>$request->password])){

                // Recuperar os dados do usuario
                $user = Auth::user();

                // Gerando o token e salvando no BD
                $token = $request->user()->createToken('api-token')->plainTextToken;

                return response()->json(
                    [
                        'status' => true,
                        'token' => $token,
                        'user' => $user,
                    ], Response::HTTP_CREATED
                );
            }
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Login ou senha incorreta.',
                ], Response::HTTP_NOT_FOUND
            );

        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e,
                ], Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function logout(User $user): JsonResponse
    {
        try {
            $user->tokens()->delete();

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Deslogado com sucesso',
                ], Response::HTTP_OK
            );

        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Erro ao deslogar, tente novamente!',
                ], Response::HTTP_BAD_REQUEST
            );
        }
    }
}
