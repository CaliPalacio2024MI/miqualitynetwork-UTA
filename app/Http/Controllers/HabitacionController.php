<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HabitacionController extends Controller
{
    public function buscar($numero)
{
    $habitacion = DB::table('llegadas')->where('NHab', (int)$numero)->first();

    if ($habitacion) {
        return response()->json($habitacion);
    } else {
        return response()->json(['error' => 'No encontrada'], 404);
    }
}
}
