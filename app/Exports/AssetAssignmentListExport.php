<?php

namespace App\Exports;

use App\Models\AssetAssignment;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssetAssignmentListExport implements FromCollection, WithHeadings, WithStyles, WithEvents
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
        'id',
        'user_id',
        'asset_id',
        'asset_type_id',
        'assign_date',
        'return_date',
        'returned',
        'damaged',
        'return_status'
    ];

    public function collection()
    {
        $q = AssetAssignment::select($this->field_list)->with(['users', 'asset_types', 'assets']);
        $filterd_keys = array_keys($this->filtered_parameter);

        for ($i = 0; $i < count($filterd_keys); $i++) {

            if ($this->filtered_parameter['name'] != null) {

                $q->orWhereHas('users', function ($query) {
                    return $query->where('name', $this->filtered_parameter['name']);
                });
                unset($this->filtered_parameter['name']);
            }

            if ($this->filtered_parameter['type'] != null) {

                $q->orWhereHas('asset_types', function ($query) {
                    return $query->where('name', $this->filtered_parameter['type']);
                });
                unset($this->filtered_parameter['type']);
            }

            if ($this->filtered_parameter[$filterd_keys[$i]] != null) {
                $q->orWhere($filterd_keys[$i], $this->filtered_parameter[$filterd_keys[$i]]);
            }
        }

        return $q->get()->map(function ($item) {
            $item->name =  $item->users ? $item->users->name : 'N/A';
            $item->asset_type =  $item->asset_types ? $item->asset_types->name : 'N/A';
            $item->asset_name =  $item->assets ? $item->assets->name :  'N/A';
            $item->damaged =  $item->damaged == 1 ? "Yes" : 'N/A';
            $item->return_status = $item->return_status == 1 ? "Yes" : 'N/A';
            $item->returned = $item->returned == 1 ? "Yes" : 'N/A';

            $itemArray = $item->toArray();

            unset(
                $itemArray['asset_type_id'],
                $itemArray['user_id'],
                $itemArray['asset_types'],
                $itemArray['users']
            );
            $reorderedItemArray = [
                'id' => $itemArray['id'],
                'name' => $itemArray['name'],
                'asset_type' => $itemArray['asset_type'],
                'asset_name' => $itemArray['asset_name']
            ] + $itemArray; // Prepend the reordered keys

            if (empty($this->all_headings)) {

                $this->all_headings = array_map(function ($value) {
                    Log::info($value);
                    return is_string($value) ? ucwords(strtolower($value)) : $value;
                }, array_keys($reorderedItemArray));
            }
            
            return $reorderedItemArray;
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
