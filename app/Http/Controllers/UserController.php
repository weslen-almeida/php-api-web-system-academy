<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function auth(Request $request): JsonResponse
    {
        $data = $request->all();
        return response()->json($data);
        try {
            $response = $this->successResponse($token, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            $response = $this->errorResponse($e);
        }
        return response()->json($response, $response['status_code']);
    }
}
