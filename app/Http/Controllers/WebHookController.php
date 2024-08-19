<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebHookController extends Controller
{
    public function getEvent(Request $request)
    {
        $data = $request->all();

        sleep(10);
        return $this->sendResponses($data);
    }

    public function sendResponses($data)
    {
        $uri = $data['url'];
        $dataSend =json_encode(
            [
                'status' => true,
                'message' => 'Evento processado com sucesso',
                'data' => [
                    'id' => 1234456,
                    'name' =>  $data['name'],
                    'email' => $data['email'],
                    'token' => 'Teste52321'
                ],
            ], Response::HTTP_CREATED
        );

        // inserir uma fila para controle
        // na fila fazer o retry
        $client = new \GuzzleHttp\Client([
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json',]
        ]);

        $response = $client->request('POST', $uri, [
            'body' => $dataSend
        ]);

        $responsejson = json_decode($response->getBody(), true);

        return $responsejson;
    }
}
