<?php

namespace App\Http\Controllers\BCP;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BCP\Llegada;
use Illuminate\Support\Carbon;
use App\Models\BCP\Catalogo;
use App\Http\Controllers\Controller;

class llegadaController extends Controller
{

    //LLEGADAS**************************************************************************
    public function index()
    {
        $datos = DB::table('llegadas')->get();
        return view('seguridaddelainformacion.bcp.llegada', compact('datos'));
    }

    public function importar(Request $request)
    {
        // Validar el archivo CSV
        $request->validate([
            'archivo_csv' => 'required|mimes:csv,txt|max:10240',
        ]);

        $archivo = $request->file('archivo_csv');
        //$rows = array_map('str_getcsv', file($archivo));

        $rows = array_filter(array_map('str_getcsv', file($archivo)), function ($row) {
            // Retener solo filas que no estén vacías (que tengan al menos un valor no vacío)
            return !empty(array_filter($row, fn($cell) => trim($cell) !== ''));
        });


        // Desactivar temporalmente las restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('llegadas')->truncate();

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Saltar encabezados

            // Saltar filas vacías por si acaso
            if (empty(array_filter($row, fn($cell) => trim($cell) !== ''))) {
                continue;
            }

            // Convertir las fechas de formato 'DD/MM/YYYY' a 'YYYY-MM-DD'
            $fechaSal = isset($row[18]) ? $this->convertirFecha($row[18]) : null;
            $fechaLlegada = isset($row[29]) ? $this->convertirFecha($row[29]) : null;

            // Limpiar los valores monetarios
            $creditoInicial = isset($row[39]) ? $this->limpiarValorMonetario($row[39]) : 0;
            $creditoDisponible = isset($row[40]) ? $this->limpiarValorMonetario($row[40]) : 0;

            // Limpiar el valor de 'Pax' y convertirlo a un número válido
            $pax = isset($row[38]) ? $this->convertirValorNumerico($row[38]) : 0;

            // Convertir valores vacíos en valores numéricos (0) INT
            $valor_a = isset($row[13]) ? $this->convertirValorNumericoInt($row[13]) : 0;
            $valor_n = isset($row[14]) ? $this->convertirValorNumericoInt($row[14]) : 0;
            $valor_j = isset($row[15]) ? $this->convertirValorNumericoInt($row[15]) : 0;
            $valor_mg = isset($row[16]) ? $this->convertirValorNumericoInt($row[16]) : 0;
            $valor_i = isset($row[17]) ? $this->convertirValorNumericoInt($row[17]) : 0;

            DB::table('llegadas')->insert([
                'Cve_Reserv'         => $row[0],
                'Nombre'             => isset($row[1]) ? $row[1] : null,
                'C'                  => isset($row[2]) ? $row[2] : null,
                'Tpo'                => isset($row[3]) ? $row[3] : null,
                'G'                  => isset($row[4]) ? $row[4] : null,
                'Seg'                => isset($row[5]) ? $row[5] : null,
                'THab'               => isset($row[6]) ? $row[6] : null,
                'Hb'                 => $this->valorNuloSiVacio($row[7] ?? null),
                'P'                  => $this->valorNuloSiVacio($row[8] ?? null),
                'NHab'               => isset($row[9]) ? $row[9] : null,
                'Plan'               => isset($row[10]) ? $row[10] : null,
                'TP'                 => isset($row[11]) ? $row[11] : null,
                'In'                 => isset($row[12]) ? $row[12] : null,
                'Valor_A'            => $valor_a,
                'Valor_N'            => $valor_n,
                'Valor_J'            => $valor_j,
                'Valor_MG'           => $valor_mg,
                'Valor_I'            => $valor_i,
                'FechaSal'           => $fechaSal,
                'Noc'                => $this->valorNuloSiVacio($row[19] ?? null),
                'Edo'                => isset($row[20]) ? $row[20] : null,
                'FPgo'               => isset($row[21]) ? $row[21] : null,
                'Tarifa'             => isset($row[22]) ? $this->limpiarValorMonetario($row[22]) : null,
                'Agencia'            => isset($row[23]) ? $row[23] : null,
                'Grupo'              => isset($row[24]) ? $row[24] : null,
                'Compania'           => isset($row[25]) ? $row[25] : null,
                'MensajesRecepcion'  => isset($row[26]) ? $row[26] : null,
                'Cod_Reserva'        => isset($row[27]) ? $row[27] : null,
                'PreCheckInWeb'      => isset($row[28]) ? $row[28] : null,
                'FechaLlegada'       => $fechaLlegada,
                'Mail'               => isset($row[30]) ? $row[30] : null,
                'Calle_Colonia'      => isset($row[31]) ? $row[31] : null,
                'Municipio_Ciudad'   => isset($row[32]) ? $row[32] : null,
                'Estado'             => isset($row[33]) ? $row[33] : null,
                'CP'                 => isset($row[34]) ? $row[34] : null,
                'Telefono'           => isset($row[35]) ? $row[35] : null,
                'Brasalete'          => isset($row[36]) ? $row[36] : null,
                'LateCheckOut'       => $this->valorNuloSiVacio($row[37] ?? null),
                'Pax'                => $pax,
                'CreditoInicial'     => $creditoInicial,
                'CreditoDisponible'  => $creditoDisponible,
            ]);
        }

        // Restaurar las restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('llegada.index')->with('success', 'Archivo cargado y registros actualizados.');
    }

    // Convertir fecha de 'DD/MM/YYYY' a 'YYYY-MM-DD'
    private function convertirFecha($fecha)
    {
        if (!empty($fecha)) {
            $fechaArray = explode('/', $fecha);
            if (count($fechaArray) == 3) {
                return implode('-', array_reverse($fechaArray));
            }
        }
        return null;
    }

    // Limpiar valores monetarios
    private function limpiarValorMonetario($valor)
    {
        return (float) str_replace([',', '$'], '', $valor); // Eliminar el simbolo '$' y las comas
    }

    // Convertir valores vacíos en valores numéricos (0) FLOAT
    private function convertirValorNumerico($valor)
    {
        return empty($valor) ? 0 : (float) $valor;
    }

    // Convertir valores vacíos en valores numéricos (0) INT
    private function convertirValorNumericoInt($valor)
    {
        return empty($valor) ? 0 : (int) $valor;
    }

    private function valorNuloSiVacio($valor)
    {
        return (isset($valor) && trim($valor) !== '') ? $valor : null;
    }



    //CHECK IN*************************************************************************************
    public function index3()
    {
        return view('seguridaddelainformacion.bcp.checkin');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'Cve_Reserv' => 'required|string|max:25',
            'Nombre' => 'required|string|max:255',
            'C' => 'nullable|string|max:25',
            'Tpo' => 'required|string|max:25',
            'G' => 'required|string|max:25',
            'Seg' => 'required|string|max:25',
            'THab' => 'required|string|max:25',
            'Hb' => 'required|integer|min:-128|max:127',
            'P' => 'required|string|max:6',
            'NHab' => 'required|integer|min:1100|max:5000',
            'Plan' => 'required|string|max:255',
            'TP' => 'required|string|max:15',
            'In' => 'nullable|string|max:25',
            'Valor_A' => 'nullable|integer|min:-128|max:127',
            'Valor_N' => 'nullable|integer|min:-128|max:127',
            'Valor_J' => 'nullable|integer|min:-128|max:127',
            'Valor_MG' => 'nullable|integer|min:-128|max:127',
            'Valor_I' => 'nullable|integer|min:-128|max:127',
            'FechaSal' => 'required|date',
            'Noc' => 'required|integer|min:-128|max:127',
            'Edo' => 'required|string|max:25',
            'FPgo' => 'required|string|max:6',
            'Tarifa' => 'required||regex:/^\d+(\.\d{1,2})?$/',
            'Agencia' => 'required|string|max:50',
            'Grupo' => 'nullable|string|max:255',
            'Compania' => 'nullable|string|max:255',
            'MensajesRecepcion' => 'nullable|string|max:255',
            'Cod_Reserva' => 'required|string|max:10',
            'PreCheckInWeb' => 'nullable|string|max:25',
            'FechaLlegada' => 'required|date|before:FechaSal',
            'Mail' => 'nullable|email',
            'Calle_Colonia' => 'nullable|string|max:255',
            'Municipio_Ciudad' => 'nullable|string|max:25',
            'Estado' => 'nullable|string|max:25',
            'CP' => 'nullable|string|max:5',
            'Telefono' => 'nullable|string|max:15',
            'Brasalete' => 'nullable|string|max:25',
            'LateCheckOut' => 'nullable|string|max:3',
            'Pax' => 'nullable|numeric', // Permite valores numéricos (incluyendo float)
            'CreditoInicial' => 'nullable|regex:/^\d+(\.\d{1,2})?$/', // Acepta números con hasta 2 decimales
            'CreditoDisponible' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
        ], [
            'Cve_Reserv.max' => 'El campo debe ser válido.',
            'Nombre.max' => 'El campo Nombre debe ser válido.',
            'C.max' => 'El campo C debe ser una cadena de texto.',
            'Tpo.max' => 'El campo Tpo debe ser una cadena de texto.',
            'G.max' => 'El campo G debe ser válido.',
            'Seg.max' => 'El campo Seg debe ser válido.',
            'THab.max' => 'El campo Thab debe ser válido.',
            'Hb.max' => 'El valor de Hb debe ser menor o igual a 127.',
            'P.max' => 'El campo P debe ser válido.',
            'NHab.max' => 'El valor de NHab debe ser menor o igual a 5000.',
            'NHab.min' => 'El valor de NHab debe ser menor o igual a 1100.',
            'Plan.max' => 'El campo Plan debe ser válido.',
            'TP.max' => 'El campo TP debe ser válido.',
            'In.max' => 'El campo In debe ser válido.',
            'Valor_A.max' => 'El valor de Valor_A debe ser menor o igual a 127.',
            'Valor_N.max' => 'El valor de Valor_N debe ser menor o igual a 127.',
            'Valor_J.max' => 'El valor de Valor_J debe ser menor o igual a 127.',
            'Valor_MG.max' => 'El valor de Valor_MG debe ser menor o igual a 127.',
            'Valor_I.max' => 'El valor de Valor_I debe ser menor o igual a 127.',
            'FechaSal.date' => 'El campo FechaSal debe ser una fecha válida.',
            'Noc.max' => 'El valor de Noc debe ser menor o igual a 127.',
            'Edo.max' => 'El campo Edo debe ser válido.',
            'FPgo.max' => 'El campo FPgo debe ser válido.',
            'Tarifa.regrex' => 'El valor de Tarifa debe ser un número válido con hasta 2 decimales.',
            'Agencia.max' => 'El campo Agencia debe ser válido.',
            'Grupo.max' => 'El campo Grupo debe ser válido.',
            'Compania.max' => 'El campo Compania debe ser válido.',
            'MensajesRecepcion.max' => 'El campo MensajesRecepcion debe ser válido.',
            'Cod_Reserva.max' => 'El campo Cod Reserva debe ser válido.',
            'PreCheckInWeb.max' => 'El campo PreCheckInWeb debe ser válido.',
            'FechaLlegada.before' => 'La fecha de llegada debe ser antes de la fecha de salida.',
            'Mail.email' => 'El campo Mail debe ser un correo electrónico válido.',
            'Calle_Colonia.max' => 'El campo Calle - Colonia debe ser válido.',
            'Municipio_Ciudad.max' => 'El campo Municipio - Ciudad debe ser válido.',
            'Estado.max' => 'El campo Estado debe ser válido.',
            'CP.max' => 'El campo CP debe ser válido.',
            'Telefono.max' => 'El campo Telefono debe ser válido.',
            'Brasalete.max' => 'El campo Brazalete debe ser válido.',
            'LateCheckOut.max' => 'El campo LateCheckOut debe ser válido.',
            'Pax.max' => 'El campo Pax debe ser numérico válido.',
            'CreditoInicial.regex' => 'El valor de Crédito Inicial debe ser un número válido con hasta 2 decimales.',
            'CreditoDisponible.regex' => 'El valor de Crédito Disponible debe ser un número válido con hasta 2 decimales.',
        ]);

        // Validación de fechas ocupadas
        $ocupada = Llegada::where('NHab', $datos['NHab'])
            ->where(function ($query) use ($datos) {
                $query->whereBetween('FechaLlegada', [$datos['FechaLlegada'], $datos['FechaSal']])
                    ->orWhereBetween('FechaSal', [$datos['FechaLlegada'], $datos['FechaSal']])
                    ->orWhere(function ($query) use ($datos) {
                        $query->where('FechaLlegada', '<=', $datos['FechaLlegada'])
                            ->where('FechaSal', '>=', $datos['FechaSal']);
                    });
            })
            ->exists();

        if ($ocupada) {
            return redirect()->back()
                ->withErrors(['error' => 'La habitación ya está ocupada entre esas fechas.'])
                ->withInput();
        }

        $datos = $request->all();

        $datos['Valor_A'] = $datos['Valor_A'] ?: 0;
        $datos['Valor_N'] = $datos['Valor_N'] ?: 0;
        $datos['Valor_J'] = $datos['Valor_J'] ?: 0;
        $datos['Valor_MG'] = $datos['Valor_MG'] ?: 0;
        $datos['Valor_I'] = $datos['Valor_I'] ?: 0;
        $datos['Pax'] = $datos['Pax'] ?: 0;
        $datos['CreditoInicial'] = $datos['CreditoInicial'] ?: 0;
        $datos['CreditoDisponible'] = $datos['CreditoDisponible'] ?: 0;

        Llegada::create($datos);

        return redirect()->route('checkin.index3')->with('success', 'Registro guardado correctamente.');
    }



    //RACK**************************************************************************************
    public function index2()
    {
        $llegadas = Llegada::all();

        $reservas = [];

        foreach ($llegadas as $llegada) {
            $fechaInicio = Carbon::parse($llegada->FechaLlegada);
            $fechaFin = Carbon::parse($llegada->FechaSal);
            $nombre = $llegada->Nombre;
            $habitacion = (int) $llegada->NHab;

            $marcarDiaSalida = true;

            while ($fechaInicio->lt($fechaFin)) {
                $fechaKey = $fechaInicio->format('Y-m-d');
                $reservas[$habitacion][$fechaKey] = $nombre;
                $fechaInicio->addDay();
            }

            if ($marcarDiaSalida) {
                $fechaKey = $fechaFin->format('Y-m-d');
                $reservas[$habitacion][$fechaKey] = $nombre;
            }
        }

        ksort($reservas);

        $fechas = collect();
        $hoy = now();

        for ($i = -10; $i < 20; $i++) {
            $fechas->push($hoy->copy()->addDays($i)->format('Y-m-d'));
        }

        $habitacionesEnReservas = collect($reservas)->keys()->map(fn($h) => (int) $h);

        $catalogo = Catalogo::whereIn('N_Hab', $habitacionesEnReservas)->get()
            ->keyBy(fn($item) => (string) $item->N_Hab);

        return view('seguridaddelainformacion.bcp.rack', compact('reservas', 'fechas', 'catalogo'));
    }
}
