<?php

namespace App\Services\Procurement;

use App\Repositories\ProcurementRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class ProcurementService
{

    public function __construct(
        private ProcurementRepository $procurementRepo,
    ) {}

    public function storeProcurement($data)
    {
        try {
            DB::beginTransaction();
            $procurement_detail = $this->procurementRepo->store($data);
            DB::commit();
            return $procurement_detail;
        } catch (Exception $exception) {
            DB::rollback();
            throw $exception;
        }
    }

    public function findProcurementById($id, $select = ['*'], $with = [])
    {
        try {
            $procurementDetail =  $this->procurementRepo->findProcurementById($id, $select, $with);
            if (!$procurementDetail) {
                throw new \Exception('Procurement Not Found', 400);
            }
            return $procurementDetail;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function updateProcurement($id, $validatedData)
    {
        try {
            $procurement_detail = $this->findProcurementById($id);
            DB::beginTransaction();
            $updateStatus = $this->procurementRepo->update($procurement_detail, $validatedData);
            DB::commit();
            return $updateStatus;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProcurementRequest($id)
    {
        try {
            $procuremetDetail = $this->findProcurementById($id);
            DB::beginTransaction();
            $status =  $this->procurementRepo->delete($procuremetDetail);
            DB::commit();
            return $status;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
