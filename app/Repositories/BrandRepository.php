<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandRepository
{

    public function getBrandlist($select=['*'],$with=[])
    {
        return Brand::select($select)->withCount($with)->get();
    }

    public function storeBrands($data)
    {
        $brand = new Brand;
        $brand->name = $data['name'];
        $brand->is_active = 1;
        $brand->save();
    }

    public function findBrandById($id)
    {
        $brand_details = Brand::where('id',$id)->first();

        return $brand_details;
    }

    public function updateBrandDetails($id, $data)
    {
        try {
            $brandDetails = self::findBrandById($id);
            $brandDetails->update($data);
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteBrands($id)
    {
        try {
            $brandDetails = self::findBrandById($id);
            $brandDetails->delete();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function toggleIsActiveStatus($id)
    {
        try {
            $clientDetail = self::findBrandById($id);
            // dd($clientDetail->is_active);
            return $clientDetail->update([
                'is_active' => $clientDetail->is_active == 1 ? 0 : 1,
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
