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
}
