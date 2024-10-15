<?php

namespace App\Exports;

use App\Models\Asset;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssetListExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection 
     */
    protected $all_headings = [];

    protected $filtered_parameter;

    public function __construct($filtered_parameter)
    {
        $this->filtered_parameter = $filtered_parameter;
    }

    protected $field_list = [
        'name',
        'type_id',
        'asset_code',
        'asset_serial_no',
        'is_working',
        'purchased_date',
        'warranty_available',
        'warranty_end_date',
        'is_available',
        'image',
    ];


    public function collection()
    {
        // dd($this->filtered_parameter);
        $q = Asset::select($this->field_list)->with('type');

        $filterd_keys = array_keys($this->filtered_parameter);
        // dd(count($filterd_keys));

        for ($i = 0; $i < count($filterd_keys); $i++) {

            if ($this->filtered_parameter['type'] != null) {
    
                $q->orWhereHas('type', function ($query) {
                    return $query->where('name', $this->filtered_parameter['type']);
                });
                unset($this->filtered_parameter['type']);
            }

            if ($this->filtered_parameter[$filterd_keys[$i]] != null) {
                $q->orWhere($filterd_keys[$i], $this->filtered_parameter[$filterd_keys[$i]]);
            }
        }
        return $q->get()->map(function ($item) {
            $item->asset_type =  $item->type ? $item->type->name : 'N/A';
            $item->warranty_available =  $item->warranty_available == 1 ? "Yes" : 'N/A';
            $item->is_available = $item->is_available == 1 ? "Yes" : 'N/A';
            $itemArray = $item->toArray();

            unset($itemArray['type_id'], $itemArray['type']);

            if (empty($this->all_headings)) {

                $this->all_headings = array_map(function ($value) {
                    Log::info($value);
                    return is_string($value) ? ucwords(strtolower($value)) : $value;
                }, array_keys($itemArray));
            }

            return $itemArray;
        });
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle($sheet->calculateWorksheetDimension())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'FFA0A0A0'],
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Set auto-size for each column
                $columns = range('A', $sheet->getHighestColumn());
                foreach ($columns as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    public function headings(): array
    {
        self::collection();
        return $this->all_headings;
    }
}
