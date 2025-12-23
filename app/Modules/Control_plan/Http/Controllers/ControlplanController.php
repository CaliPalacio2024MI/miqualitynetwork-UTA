<?php

namespace App\Modules\Control_plan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use App\Modules\Control_plan\Models\Planes;
use App\Modules\Control_plan\Models\Acciones;
use App\Modules\Control_plan\Models\Reprogramados;


class ControlplanController extends Controller{
    public function home(){
        return view('modules.controlplan.create');
    }

    public function print(Request $request){
        $data = json_decode($request->query('data'), true);

        $signature_key = null;
        $signature_value = null;

        $source = null;
        $property = null;
        $responsible = null;

        foreach ($data as $index => $item) {
            //busca y extrae la posicion del valor signature
            if (isset($item['signature'])) {
                $signature_key = $index;
                $signature_value = $item['signature'];
                
            }

            if (isset($item['origen'])) {
                $source = $item['origen'];
                
            }

            if (isset($item['propiedad'])) {
                $property = $item['propiedad'];
                
            }
            
            if (isset($item['responsable'])) {
                $responsible = $item['responsable'];
                
            }
        }

        //elimina el valor de la firma
        unset($data[$signature_key]);
        //crea un nuevo arreglo sin el valor de la firma
        $new = json_encode($data);
        $new_data = json_decode($new);

        //crea el plan y recupera el id para usarlo como llave foranea
        $id_plan = Planes::insertGetId([
            'rfc' => Auth::user()->rfc,
            'no' => $this->folioNumber($source),
            'origen' => $source,
            'propiedad' => $property,
            'responsable' => $responsible,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //introduce todos los datos dentro del arreglo
        foreach ($new_data as $element) {
            Acciones::create([
                'id_plan' => $id_plan,
                'proceso' => $element->proceso,
                'o_mejora' => $element->oportunidad,
                'criterio' => $element->criterio,
                'c_raiz' => $element->causa_raiz,
                'tipo_sol' => $element->tipo_solucion,
                'desc_sol' => $element->descripcion,
                'costo' => $element->costo,
                'observaciones' => $element->observacion,
                'fecha_creacion' => date("Y/m/d"),
                'estado' => "Abierto",
                'fecha_inicio' => $element->fecha_inicio,
                'fecha_fin' => $element->fecha_cumplimiento
            ]);
        }

        $pdf = PDF::loadView('modules.controlplan.layouts.pdf', ['list'=>$new_data, 'signature'=>$signature_value, 'responsible'=>$responsible]);
        //$pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->stream('planes_de_acción.pdf');
    }

    //funcion para generar el folio
    private function folioNumber($source){
        $last_folio = Planes::where('origen', $source)->orderBy('created_at', 'desc')->first();
        $year = date('y');
        $counter = 1;

        //separa las palabras por espacios y parentesis
        $words = preg_split("/\\s+|\\(|\\)/", $source);
        $acronym = null;
        $upper = null;

        //recupera solo las iniciales
        foreach ($words as $w) {
        $acronym .= mb_substr($w, 0, 1);
        }

        $upper = strtoupper($acronym);

        //si existe un folio para el origen
        if ($last_folio) {
            //recupera el folio
            $folio = $last_folio->no;
            //elimina las letras
            $folio = preg_replace('/[a-zA-Z]/', '', $folio);
            //elimina el año
            $folio = preg_replace('/(\d{2})$/', '', $folio);
            //elimina los ceros
            $folio = ltrim($folio, "0");
            //asigna el resultado a la variable counter
            $counter = (int)$folio;
        }

        //genera el nuevo folio
        $new_folio = $upper . str_pad($counter, 4, '0', STR_PAD_LEFT) . $year;
        //ejemplo: CL001425

        while (Planes::where('no', $new_folio)->exists()) {
            //incrementa el contador hasta encontrar un folio unico
            $counter++;
            $new_folio = $upper . str_pad($counter, 4, '0', STR_PAD_LEFT) . $year;
        }

        return $new_folio;
    }

    public function listPlan(){
        $data = array(
            'list'=>Planes::where('rfc', Auth::user()->rfc)->get()
        );

        return view('modules.controlplan.update_test', $data);
    }

    public function showDetails(Planes $plan){
        // Eager load reviews
        $plan->load('acciones'); // This adds the 'reviews' relationship to the product object

        return response()->json($plan);
    }

    public function total(){
        $total_plan = Planes::where('rfc', Auth::user()->rfc)->get()->count();
        $total_cost = Acciones::get()->sum('costo');
        $corrective = Acciones::where('tipo_sol','Acción correctiva')->get()->count();
        $correction = Acciones::where('tipo_sol','Corrección')->get()->count();
        $improve = Acciones::where('tipo_sol','Accion de mejora')->get()->count();
        $total_open = Acciones::where('estado','Abierto')->get()->count();
        $total_closed = Acciones::where('estado','Cerrado')->get()->count();
        $total_postponed = Acciones::where('estado','Reprogramado')->get()->count();
        $total_effective = Acciones::where('resultado','Eficaz')->get()->count();
        $total_not_effective = Acciones::where('resultado','No eficaz')->get()->count();

        $json_result =[$total_open, $total_closed, $total_postponed, $total_effective, $total_not_effective];
        
        return view('modules.controlplan.statistics', ['corrective'=>$corrective, 'correction'=>$correction, 'improve'=>$improve, 'plan'=>$total_plan, 'cost'=>$total_cost, 'json_result'=>$json_result]);
    }
}