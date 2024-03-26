<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GiphyController extends Controller {

    const API_KEY = '7cI3EcrPoPKycpby6sjmwpybMFzZ7GUR';
    
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function searchGifs(Request $request) {
        $query = $request->input('query');
        $client = new Client();
        
        try {
            $response = $client->request('GET', 'https://api.giphy.com/v1/gifs/search', [
                'query' => [
                    'api_key' => self::API_KEY,
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

    public function getGifById(Request $request) {
        $gifId = $request->input('ID');

        $response = Http::get("https://api.giphy.com/v1/gifs/{$gifId}", [
            'api_key' => self::API_KEY
        ]);

    return $response->json();
    }
}
