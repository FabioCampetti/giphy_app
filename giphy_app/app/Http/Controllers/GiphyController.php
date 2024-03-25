<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GiphyController extends Controller {
    
    public function searchGifs(Request $request) {
        $query = $request->input('query');
        $apiKey = 'TU_CLAVE_DE_API_DE_GIPHY';
        $client = new Client();
        
        try {
            $response = $client->request('GET', 'https://api.giphy.com/v1/gifs/search', [
                'query' => [
                    'api_key' => $apiKey,
                    'q' => $query
                ]
            ]);

            $gifs = json_decode($response->getBody()->getContents(), true);

            // Haz algo con los GIFs obtenidos
            return response()->json($gifs);
        } catch (\Exception $e) {
            // Maneja cualquier error que pueda ocurrir al hacer la solicitud a la API de Giphy
            return response()->json(['error' => 'Error al buscar GIFs']);
        }
    }
}
