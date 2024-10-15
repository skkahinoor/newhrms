<?php

namespace App\Repositories;

use App\Models\Asset;
use App\Models\AssetAssignment;

class AssetAssignmentRepository
{
    public function getAllAssetAssignments($filterParameters, $select, $with)
    {
        return  AssetAssignment::select($select)->with($with)
            ->when(isset($filterParameters['type']), function ($query) use ($filterParameters) {
                $query->whereHas('asset_types', function ($query) use ($filterParameters) {
                    $query->where('id', $filterParameters['type']);
                });
            })
            ->when(isset($filterParameters['name']), function ($query) use ($filterParameters) {
                $query->whereHas('users', function ($query) use ($filterParameters) {
                    $query->where('name', $filterParameters['name']);
                });
            })
            ->when(isset($filterParameters['assign_date']), function ($query) use ($filterParameters) {
                $query->where('assign_date', 'like', '%' . $filterParameters['assign_date'] . '%');
            })
            ->when(isset($filterParameters['return_date']), function ($query) use ($filterParameters) {
                $query->where('return_date', $filterParameters['return_date']);
            })
            ->when(isset($filterParameters['damaged']), function ($query) use ($filterParameters) {
                $query->where('damaged', 'like', '%' . $filterParameters['damaged'] . '%');
            })
            ->when(isset($filterParameters['return_status']), function ($query) use ($filterParameters) {
                $query->where('return_status', $filterParameters['return_status']);
            })
            ->get()->map(function ($item) {
                // dd($item);
                $item->assign_to = $item->users->name;
                $item->asset_name = $item->assets->name;
                $item->asset_types = $item->asset_types->name;
                $item->assign_date = date('d-m-Y', strtotime($item->assign_date));
                $item->return_date = $item->return_date ? date('d-m-Y', strtotime($item->return_date)) : null;

                return $item;
            });
    }
}
