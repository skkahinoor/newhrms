<?php

namespace App\Exports;

use App\Models\LeadEnquery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LeadEnqueryExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return LeadEnquery::with([
            'leadSource' => function ($query) {
                $query->select('id', 'name');
            },
            'leadCategory' => function ($query) {
                $query->select('id', 'name');
            },
            'status' => function ($query) {
                $query->select('id', 'name');
            },
            'leadAgent' => function ($query) {
                $query->select('id', 'username'); // Assuming 'name' is the column in lead_agents table
            },
        ])->get()->map(function ($lead) {
            return [
                'name' => $lead->name,
                'city' => $lead->city,
                'email' => $lead->email,
                'state' => $lead->state,
                'companyname' => $lead->companyname,
                'country' => $lead->country,
                'website' => $lead->website,
                'postalcode' => $lead->postalcode,
                'number' => $lead->number,
                'address' => $lead->address,
                'message' => $lead->message,
                'leadsource ID' => $lead->leadsource, //Passing Id of lead Source
                'leadsource' => $lead->leadSource->name ?? '',
                'leadcategory ID' => $lead->leadcategory, //Passing Id of lead Category
                'leadcategory' => $lead->leadCategory->name ?? '',
                'leadstatus ID' => $lead->leadstatus, //Passing Id of lead Status
                'leadstatus' => $lead->status->name ?? '',
                'leadagent ID' => $lead->leadagent, //Passing Id of lead Agent
                'leadagent' => $lead->leadAgent->username ?? '',
            ];
        });
    }

    /**
     * Define the headings for the exported Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'name',
            'city',
            'email',
            'state',
            'companyname',
            'country',
            'website',
            'postalcode',
            'number',
            'address',
            'message',
            'leadsource ID',
            'leadsource',
            'leadcategory ID',
            'leadcategory',
            'leadstatus ID',
            'leadstatus',
            'leadagent ID',
            'leadagent',
        ];
    }

    /**
     * Apply styles to the heading row.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Bold the first row (headings)
            1 => ['font' => ['bold' => true]],
        ];
    }
}
