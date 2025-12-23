<?php

namespace App\Modules\Bsc\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class ConsumeApi extends Controller
{
public function index()
{
    $url = 'https://miclima.mimundodigital.mx/api/indicadores?periodo=Diciembre%202024&nombrePropiedad=Palacio%20Mundo%20Imperial';
    $response = Http::get($url);
    $datos = $response->json();
    //pasar datos a la vista
    return view('modules.bsc.indicadores.api', compact('datos'));
}
public function chart()
{
    $url = 'https://miclima.mimundodigital.mx/api/indicadores?periodo=Diciembre%202024&nombrePropiedad=Palacio%20Mundo%20Imperial';
    $response = Http::get($url);
    $datos = $response->json();

    $labels = [];
    $resultados = [];
    $promediosEsperados = [];

    foreach ($datos as $dato) {
        $labels[] = $dato['departamento'];
        $resultados[] = floatval(str_replace('%', '', $dato['resultado']));
        $promediosEsperados[] = floatval(str_replace('%', '', $dato['promedio_esperado']));
    }

    return view('indicadores.grafico', compact('labels', 'resultados', 'promediosEsperados'));
}


public function showForm()
    {
        // URL de ejemplo que proporcionaste
        $exampleUrl = 'https://miclima.mimundodigital.mx/api/indicadores?periodo=Diciembre%202024&nombrePropiedad=Palacio%20Mundo%20Imperial';
        
        return view('api-form', ['exampleUrl' => $exampleUrl]);
    }

    public function fetchData(Request $request)
    {
        // Validar la entrada
        $validator = Validator::make($request->all(), [
            'api_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $client = new Client();
            $response = $client->get($request->api_url);
            $data = json_decode($response->getBody(), true);

            // Verificar si los datos son un array
            if (!is_array($data)) {
                throw new \Exception("La respuesta de la API no es un formato válido");
            }

            return view('api-results', [
                'data' => $data,
                'apiUrl' => $request->api_url
            ]);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al consumir la API: ' . $e->getMessage())
                ->withInput();
        }
    }


}
