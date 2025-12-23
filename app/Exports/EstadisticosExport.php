<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCharts;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Chart\{
    Chart,
    Legend,
    Title,
    PlotArea,
    DataSeries,
    DataSeriesValues
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class EstadisticosExport implements WithTitle, WithEvents, WithCharts
{
    private string $mostrar;
    private array  $datos;

    public function __construct(string $mostrar, array $datos)
    {
        $this->mostrar = $mostrar;
        $this->datos    = $datos;
    }

    public function title(): string
    {
        return 'Estadísticas';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Worksheet $sheet */
                $sheet = $event->sheet->getDelegate();

                // Título principal
                $sheet->mergeCells('A1:H1');
                $sheet->setCellValue('A1', 'ESTADÍSTICAS LINEALES DE ACCIDENTES');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Definir posiciones para cada bloque
                $bloques = [
                    'departamento' => ['chart' => 'A3',  'table' => 'F3'],
                    'mes'          => ['chart' => 'A25', 'table' => 'F25'],
                    'dias'         => ['chart' => 'A47', 'table' => 'F47'],
                    'partes'       => ['chart' => 'A69', 'table' => 'F69'],
                ];

                // Escribir tablas junto a gráficas
                foreach ($bloques as $key => $pos) {
                    if ($this->mostrar === 'todas' || $this->mostrar === $key) {
                        preg_match('/([A-Z]+)(\d+)/', $pos['table'], $m);
                        $colTab = $m[1];
                        $rowTab = (int)$m[2];

                        // Encabezados de tabla
                        $sheet->setCellValue("{$colTab}{$rowTab}", 'Etiqueta');
                        $sheet->setCellValue(chr(ord($colTab) + 1) . $rowTab, 'Valor');
                        $sheet->getStyle("{$colTab}{$rowTab}:" . chr(ord($colTab) + 1) . $rowTab)
                            ->getFont()->setBold(true);
                        $sheet->getStyle("{$colTab}{$rowTab}:" . chr(ord($colTab) + 1) . $rowTab)
                            ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                        // Filas de datos
                        foreach ($this->datos[$key]['labels'] as $i => $label) {
                            $r = $rowTab + 1 + $i;
                            $sheet->setCellValue("{$colTab}{$r}", $label);
                            $sheet->setCellValue(chr(ord($colTab) + 1) . $r, $this->datos[$key]['values'][$i]);
                            $sheet->getStyle("{$colTab}{$r}:" . chr(ord($colTab) + 1) . $r)
                                ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                        }
                    }
                }

                // Auto-size columnas A–H
                foreach (range('A', 'H') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }

    public function charts(): array
    {
        $charts    = [];
        $bloques   = [
            'departamento' => ['chart' => 'A3',  'table' => 'F3'],
            'mes'          => ['chart' => 'A25', 'table' => 'F25'],
            'dias'         => ['chart' => 'A47', 'table' => 'F47'],
            'partes'       => ['chart' => 'A69', 'table' => 'F69'],
        ];
        $titles    = [
            'departamento' => 'Accidentes por Departamento',
            'mes'          => 'Accidentes por Mes',
            'dias'         => 'Días Perdidos por Incapacidad',
            'partes'       => 'Partes del cuerpo afectadas',
        ];

        foreach (['departamento', 'mes', 'dias', 'partes'] as $key) {
            if ($this->mostrar === 'todas' || $this->mostrar === $key) {
                $pos = $bloques[$key];
                // Posiciones
                preg_match('/(\d+)/', $pos['chart'], $mc);
                $chartRow   = (int)$mc[1];
                preg_match('/([A-Z]+)(\d+)/', $pos['table'], $mt);
                $colTab     = $mt[1];
                $rowTab     = (int)$mt[2];
                $count      = count($this->datos[$key]['labels']);

                // Rangos de datos desde la tabla
                $startRow   = $rowTab + 1;
                $endRow     = $rowTab + $count;
                $labelRange = "{$colTab}{$startRow}:{$colTab}{$endRow}";
                $valueRange = chr(ord($colTab) + 1) . "{$startRow}:" . chr(ord($colTab) + 1) . "{$endRow}";

                $xAxisValues = new DataSeriesValues('String',  "'{$this->title()}'!{$labelRange}", null, $count);
                $dataValues  = new DataSeriesValues('Number', "'{$this->title()}'!{$valueRange}", null, $count);

                $series = new DataSeries(
                    DataSeries::TYPE_LINECHART,
                    DataSeries::GROUPING_STANDARD,
                    range(0, 0),
                    [],
                    [$xAxisValues],
                    [$dataValues]
                );

                $plotArea = new PlotArea(null, [$series]);
                $legend   = new Legend(Legend::POSITION_RIGHT, null, false);
                $chart    = new Chart(
                    $titles[$key],
                    new Title($titles[$key]),
                    $legend,
                    $plotArea
                );

                // Ajustar tamaño: columnas A–D y filas => mayor altura
                $bottomRow = $chartRow + 15;
                $chart->setTopLeftPosition($pos['chart'])
                    ->setBottomRightPosition('D' . $bottomRow);

                $charts[] = $chart;
            }
        }

        return $charts;
    }
}
