<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Log; // Asegúrate de tener esto al inicio del archivo (arriba)



class CentroConsumoController extends Controller
{
    public function abrirCuenta(Request $request)
    {
        $request->validate([
            'habitacion' => 'required|numeric',
            'pax' => 'required|numeric',
            'mesa' => 'required|numeric',
            'mesero' => 'required|string',
            'propiedad' => 'required|string',
            'centro_consumo' => 'required|string',
            'huesped' => 'required|string',
        ]);

        try{

        DB::table('centrosdeconsumo')
       ->where('Propiedad', $request->propiedad)
       ->where('Centroconsumo', $request->centro_consumo)
       ->where('Mesa', $request->mesa)
        ->update([
        'Habitacion' => $request->habitacion,
        'Pax' => $request->pax,
        'Mesero' => $request->mesero,
        'Huesped' => $request->huesped

    ]);

    DB::table('centrosdeconsumo_respaldo')
   ->where('Propiedad', $request->propiedad)
   ->where('Centroconsumo', $request->centro_consumo)
   ->where('Mesa', $request->mesa)
   ->update([
       'Habitacion' => $request->habitacion,
       'Pax' => $request->pax,
       'Mesero' => $request->mesero,
       'Huesped' => $request->huesped
   ]);


        return response()->json(['success' => true]);
    }catch (\Exception $e) {
        \Log::error('Error al abrir cuenta: ' . $e->getMessage());
        return response()->json(['error' => 'Ocurrió un error al guardar'], 500);
    }
    }
    public function obtenerCuentasMarche()
{
    $cuentas = DB::table('centrosdeconsumo')
        ->where('Centroconsumo', 'Marche')
        ->where('Propiedad', 'Palacio Mundo Imperial')
        ->get();

    return response()->json($cuentas);
}

public function actualizarConsumo(Request $request)
{
    $request->validate([
        'mesa' => 'required|numeric',
        'categoria' => 'required|string',
        'cantidad' => 'required|numeric',
        'descripcion' => 'required|string',
        'importe' => 'required|numeric',
    ]);

    DB::table('centrosdeconsumo')
        ->where('Propiedad', 'Palacio Mundo Imperial')
        ->where('Centroconsumo', 'Marche')
        ->where('Mesa', $request->mesa)
        ->update([
            'Categoria' => $request->categoria,
            'Cantidad' => $request->cantidad,
            'Descripcion' => $request->descripcion,
            'Importe' => $request->importe
        ]);

        DB::table('centrosdeconsumo_respaldo')
        ->where('Propiedad', 'Palacio Mundo Imperial')
        ->where('Centroconsumo', 'Marche')
        ->where('Mesa', $request->mesa)
        ->update([
            'Categoria' => $request->categoria,
            'Cantidad' => $request->cantidad,
            'Descripcion' => $request->descripcion,
            'Importe' => $request->importe
        ]);

    return response()->json(['success' => true]);
}

public function actualizarConsumoConcatenado(Request $request): JsonResponse
{
    try {
        $request->validate([
            'mesa' => 'required|numeric',
            'categoria' => 'required|string',
            'cantidad' => 'required|numeric',
            'descripcion' => 'required|string',
            'importe' => 'required|numeric',
        ]);

        DB::table('centrosdeconsumo')
            ->where('Propiedad', 'Palacio Mundo Imperial')
            ->where('Centroconsumo', 'Marche')
            ->where('Mesa', $request->mesa)
            ->update([
                'Categoria' => DB::raw("CONCAT_WS(', ', Categoria, '{$request->categoria}')"),
                'Cantidad' => DB::raw("CONCAT_WS(', ', Cantidad, '{$request->cantidad}')"),
                'Descripcion' => DB::raw("CONCAT_WS(', ', Descripcion, '{$request->descripcion}')"),
                'Importe' => DB::raw("CONCAT_WS(', ', Importe, '{$request->importe}')"),
            ]);

            DB::table('centrosdeconsumo_respaldo')
            ->where('Propiedad', 'Palacio Mundo Imperial')
            ->where('Centroconsumo', 'Marche')
            ->where('Mesa', $request->mesa)
            ->update([
                'Categoria' => DB::raw("CONCAT_WS(', ', Categoria, '{$request->categoria}')"),
                'Cantidad' => DB::raw("CONCAT_WS(', ', Cantidad, '{$request->cantidad}')"),
                'Descripcion' => DB::raw("CONCAT_WS(', ', Descripcion, '{$request->descripcion}')"),
                'Importe' => DB::raw("CONCAT_WS(', ', Importe, '{$request->importe}')"),
            ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        Log::error('Error en actualizarConsumoConcatenado: ' . $e->getMessage());
        return response()->json(['error' => 'Error interno del servidor.'], 500);
    }
}

public function detalleMesa($mesa)
{
    $registro = DB::table('centrosdeconsumo')
        ->where('Propiedad', 'Palacio Mundo Imperial')
        ->where('Centroconsumo', 'Marche')
        ->where('Mesa', $mesa)
        ->first();

    return response()->json($registro);
}



public function obtenerCuenta($habitacion): JsonResponse
{
    try {
        $habitacion = (int) $habitacion;

        $cuenta = DB::table('centrosdeconsumo')
    ->where('Propiedad', 'LIKE', '%Palacio Mundo Imperial%')
    ->where('Centroconsumo', 'Marche')
    ->where('Habitacion', $habitacion)
    ->first();


        if (!$cuenta) {
            \Log::error("No se encontró cuenta con habitación $habitacion");
            return response()->json(['error' => 'No se pudo generar el cheque. Verifica que exista la habitación.'], 404);
        }

        // Adaptar campo para el PDF
        $cuenta->Nombre = $cuenta->Huesped ?? '-';

        return response()->json($cuenta);
    } catch (\Exception $e) {
        \Log::error("Error en obtenerCuenta: " . $e->getMessage());
        return response()->json(['error' => 'Error interno del servidor.'], 500);
    }
}

public function limpiarCheque($habitacion)
{
    try {
        DB::table('centrosdeconsumo')
            ->where('Habitacion', $habitacion)
            ->update([
                'Habitacion'   => null,
                'Huesped'      => null,
                'Pax'          => null,
                'Mesero'       => null,
                'Categoria'    => null,
                'Cantidad'     => null,
                'Descripcion'  => null,
                'Importe'      => null
            ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error("Error al limpiar cheque: " . $e->getMessage());
        return response()->json(['error' => 'Error al limpiar datos después del cheque'], 500);
    }
}


public function registrarPropina(Request $request)
{
    $request->validate([
        'mesa' => 'required|numeric',
        'propina' => 'required|numeric|min:0',
        'descuento' => 'required|numeric|min:0'
    ]);

    try {
        $actualizados = DB::table('centrosdeconsumo')
            ->where('Mesa', $request->mesa)
            ->whereNotNull('Habitacion') // Asegura que hay cuenta abierta
            ->update([
                'Propina' => $request->propina,
                'Descuento' => $request->descuento
            ]);

        if ($actualizados > 0) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'No se encontró una cuenta abierta para esa mesa.'], 404);
        }
    } catch (\Exception $e) {
        \Log::error('Error al registrar propina: ' . $e->getMessage());
        return response()->json(['error' => 'Error interno al registrar la propina.'], 500);
    }
}
public function guardarFormaPago(Request $request)
{
    $request->validate([
        'habitacion' => 'required|string',
        'formaPago' => 'required|string'
    ]);

    try {
        $actualizados = DB::table('centrosdeconsumo')
            ->where('Habitacion', $request->habitacion)
            ->update(['Forma_Pago' => $request->formaPago]);

        if ($actualizados > 0) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'No se encontró la habitación.']);
        }
    } catch (\Exception $e) {
        \Log::error("Error al guardar forma de pago: " . $e->getMessage());
        return response()->json(['error' => 'Error al actualizar la forma de pago.']);
    }
}

public function todasCuentas(): \Illuminate\Http\JsonResponse
{
    $data = DB::table('centrosdeconsumo')->get(); // ← Aquí toma la tabla
    return response()->json($data);
}

// Obtener todos los registros desde centrosdeconsumo_respaldo
public function todasCuentasRespaldo(): \Illuminate\Http\JsonResponse
{
    $data = DB::table('centrosdeconsumo_respaldo')->get();
    return response()->json($data);
}


// Limpiar los campos de respaldo
public function limpiarRespaldo(): \Illuminate\Http\JsonResponse
{
    try {
        DB::table('centrosdeconsumo_respaldo')->update([
            'Habitacion'   => null,
            'Huesped'      => null,
            'Pax'          => null,
            'Mesero'       => null,
            'Categoria'    => null,
            'Cantidad'     => null,
            'Descripcion'  => null,
            'Importe'      => null,
            'Propina'      => null,
            'Descuento'    => null,
            'Forma_Pago'   => null
        ]);
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error("Error al limpiar respaldo: " . $e->getMessage());
        return response()->json(['success' => false], 500);
    }
}


public function limpiarMesa($mesa): \Illuminate\Http\JsonResponse
{
    try {
        DB::table('centrosdeconsumo')
            ->where('Mesa', $mesa)
            ->update([
                'Habitacion' => null,
                'Huesped' => null,
                'Pax' => null,
                'Mesero' => null,
                'Categoria' => null,
                'Cantidad' => null,
                'Descripcion' => null,
                'Importe' => null,
                'Propina' => null,
                'Descuento' => null,
                'Forma_Pago' => null // ✅ sin coma al final
            ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error('Error al limpiar mesa: ' . $e->getMessage());
        return response()->json(['error' => 'Error interno al limpiar la mesa.'], 500);
    }
}
public function guardarPropinaDescuentoRespaldo(Request $request): JsonResponse
{
    try {
        DB::table('centrosdeconsumo_respaldo')
            ->where('Habitacion', $request->habitacion)
            ->update([
                'Propina' => $request->propina,
                'Descuento' => $request->descuento,
                'Forma_Pago' => $request->formaPago
            ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error("Error al guardar propina y descuento en respaldo: " . $e->getMessage());
        return response()->json(['success' => false], 500);
    }
}

public function obtenerCuentaRespaldo($habitacion): JsonResponse
{
    $cuenta = DB::table('centrosdeconsumo_respaldo')
        ->where('Habitacion', $habitacion)
        ->first();

    if (!$cuenta) {
        return response()->json(['error' => 'No se encontr\u00f3 una cuenta en respaldo para esta habitación.'], 404);
    }

    return response()->json($cuenta);
}





}





