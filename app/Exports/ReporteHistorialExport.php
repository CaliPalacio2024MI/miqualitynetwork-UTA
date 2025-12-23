<?php

namespace App\Exports;

use App\Models\FormularioAccidente;
use App\Models\Propiedades;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReporteHistorialExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithEvents
{
    protected $request;
    protected $hotelNombre;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // Obtener nombre de la propiedad
        if ($request->filled('hotel')) {
            $this->hotelNombre = optional(Propiedades::where('id_propiedad', $request->hotel)->first())->nombre_propiedad ?? 'Desconocido';
        } else {
            $this->hotelNombre = 'Todos los hoteles';
        }
    }

    public function collection()
    {
        $query = FormularioAccidente::select(
            'nombre_lesionado',
            'edad_lesionado',
            'direccion_particular',
            'departamento_evento',
            'fecha_evento'
        );

        if ($this->request->filled('hotel')) {
            $query->where('propiedad_id', $this->request->hotel);
        }

        if ($this->request->filled('fecha_inicio')) {
            $query->whereDate('fecha_evento', '>=', $this->request->fecha_inicio);
        }

        if ($this->request->filled('fecha_fin')) {
            $query->whereDate('fecha_evento', '<=', $this->request->fecha_fin);
        }

        if ($this->request->filled('nombre')) {
            $query->where('nombre_lesionado', 'like', '%' . $this->request->nombre . '%');
        }

        return $query->orderBy('fecha_evento', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Edad',
            'Dirección',
            'Departamento',
            'Fecha del Evento',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Estilo encabezado (fila 4)
        $sheet->getStyle('A4:E4')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '002448']
            ],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // Zebra rows (desde fila 5)
        $highestRow = $sheet->getHighestRow();
        for ($row = 5; $row <= $highestRow; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:E{$row}")->getFill()->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB("F2F2F2");
            }
        }

        // Autoajuste de columnas
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        return [];
    }

    public function title(): string
    {
        return 'Reporte de Accidente';
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $fechaInicio = $this->request->fecha_inicio ?? 'Sin filtro';
                $fechaFin = $this->request->fecha_fin ?? 'Sin filtro';

                // Fila 1: Título
                $sheet->setCellValue('A1', 'REPORTE DE ACCIDENTE');
                $sheet->mergeCells('A1:E1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                // Fila 2: Propiedad
                $sheet->setCellValue('A2', "Propiedad: {$this->hotelNombre}");
                $sheet->mergeCells('A2:E2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                // Fila 3: Fechas
                $sheet->setCellValue('A3', "Fechas: {$fechaInicio} a {$fechaFin}");
                $sheet->mergeCells('A3:E3');
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => ['italic' => true],
                    'alignment' => ['horizontal' => 'center'],
                ]);
            }
        ];
    }
}
