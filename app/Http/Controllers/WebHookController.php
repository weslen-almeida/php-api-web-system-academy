<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebHookController extends Controller
{
    public function getEvent(Request $request)
    {
        $data = $request->all();

        // delay de uns 10 segundos e chamar a função abaixo

        return $this->sendResponses();
    }

    public function sendResponses()
    {
        //url para enviar a requisição depois de processada
        $uri = '';

        $data = [
            'id' => '1234456',
            'name' =>  'fulano de tal'
        ];

        $dataSend =json_encode(
            [
                'status' => true,
                'message' => 'Evento processado com sucesso',
                'data' => $data,
            ], Response::HTTP_CREATED
        );

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
