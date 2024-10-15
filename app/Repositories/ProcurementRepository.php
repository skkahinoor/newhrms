<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Procurement;

class ProcurementRepository
{

    public function getAllRequests($filterParameters, $select, $with)
    {
        $result = Procurement::select($select)->with($with)
            ->when(isset($filterParameters['user_id']), function ($query) use ($filterParameters) {
                $query->whereHas('users', function ($query) use ($filterParameters) {
                    $query->where('id', $$filterParameters['user_id']);
                });
            })->when(isset($filterParameters['asset_type_id']), function ($query) use ($filterParameters) {
                $query->whereHas('asset_types', function ($query) use ($filterParameters) {
                    $query->where('id', $$filterParameters['asset_type_id']);
                });
            })
            ->when(isset($filterParameters['brand_id']), function ($query) use ($filterParameters) {
                $query->whereHas('brands', function ($query) use ($filterParameters) {
                    $query->where('id', $$filterParameters['brand_id']);
                });
            })
            ->when(isset($filterParameters['request_date']), function ($query) use ($filterParameters) {
                $query->where('id', $$filterParameters['request_date']);
            })
            ->when(isset($filterParameters['delivery_date']), function ($query) use ($filterParameters) {
                $query->where('id', $$filterParameters['delivery_date']);
            })->get()->map(function ($item) {
                // dd($item->toArray());
                $item->name = $item->users->name;
                $item->asset_types = $item->asset_types->name;
                $item->brand = $item->brands->name;
                $item->request_date = date('d-m-Y', strtotime($item->request_date));
                $item->delivery_date = $item->delivery_date ? date('d-m-Y', strtotime($item->delivery_date)) : null;

                return $item;
            });

        // dd($result->toArray());
        return $result;
    }

    public function getProcruementNumber()
    {
        $p_id = Procurement::latest()->first();
        $company_name = str_replace(' ', '', Company::first()->name);
        if ($p_id) {
            return $company_name . date('Y') . $p_id->id + 1;
        } else {
            return $company_name . date('Y') . 1;
        }
    }

    public function store($data)
    {
        return Procurement::create($data)->fresh();
    }

    public function findProcurementById($id, $select = ['*'], $with = [])
    {
        return Procurement::select($select)
            ->with($with)
            ->where('id', $id)
            ->first();
    }

    public function update($procurement_detail, $validatedData)
    {
        return $procurement_detail->update($validatedData);
    }

    public function delete($procuremetDetail)
    {
        return $procuremetDetail->delete();
    }
}
