<?php

namespace App\Imports;

use App\Models\LeadEnquery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadEnqueryImport implements ToModel, WithHeadingRow
{
    /**
     * Define how each row of the imported file should be mapped to the model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new LeadEnquery([
            'name'          => $row['name'],
            'city'          => $row['city'],
            'email'         => $row['email'],
            'state'         => $row['state'],
            'companyname'   => $row['companyname'],
            'country'       => $row['country'],
            'website'       => $row['website'],
            'postalcode'    => $row['postalcode'],
            'number'        => $row['number'],
            'address'       => $row['address'],
            'message'       => $row['message'],
            'leadsource'    => $row['leadsource'],
            'leadcategory'  => $row['leadcategory'],
            'leadstatus'    => $row['leadstatus'],
            'leadagent'     => $row['leadagent'],
            // Add other fields you want to map
        ]);
    }
}
