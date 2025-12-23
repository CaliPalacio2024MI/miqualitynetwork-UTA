<?php

namespace App\Exports;

use App\Models\Propiedades;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReporteHistorialExportIndividual implements FromCollection, WithHeadings, WithStyles, WithTitle, WithEvents
{
    protected $registro;
    protected $nombrePropiedad;

    public function __construct($registro)
    {
        $this->registro = $registro;
        $this->nombrePropiedad = optional($registro->propiedad)->nombre_propiedad ?? 'Sin propiedad';
    }

    public function collection()
    {
        return collect([
            [
                $this->registro->nombre_lesionado,
                $this->registro->edad_lesionado,
                $this->registro->direccion_particular,
                $this->registro->departamento_evento,
                $this->registro->fecha_evento,
            ]
        ]);
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
        // Estilo de encabezado (fila 4)
        $sheet->getStyle('A4:E4')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '002448']
            ],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // Estilo fila de datos (fila 5)
        $sheet->getStyle('A5:E5')->getFill()->setFillType(Fill::FILL_SOLID)
              ->getStartColor()->setRGB("F2F2F2");

        // Autoajuste de columnas
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        return [];
    }

    public function title(): string
    {
        return 'Reporte Individual';
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Fila 1: Título
                $sheet->setCellValue('A1', 'REPORTE DE ACCIDENTE INDIVIDUAL');
                $sheet->mergeCells('A1:E1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                // Fila 2: Propiedad
                $sheet->setCellValue('A2', "Propiedad: {$this->nombrePropiedad}");
                $sheet->mergeCells('A2:E2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                // Fila 3: Fecha del Evento
                $sheet->setCellValue('A3', "Fecha del Evento: {$this->registro->fecha_evento}");
                $sheet->mergeCells('A3:E3');
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => ['italic' => true],
                    'alignment' => ['horizontal' => 'center'],
                ]);
            }
        ];
    }
}
