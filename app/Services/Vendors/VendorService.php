<?php

namespace App\Services\Vendors;

use App\Repositories\VendorRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class VendorService
{

    public function __construct(
        private VendorRepository $vendorRepo
    ) {}
    
    public function saveVendorDetails($data){
        try {
            DB::beginTransaction();
            $vendorDetails = $this->vendorRepo->store($data);
            DB::commit();
            return $vendorDetails;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
