<?php

namespace App\Services\AssetManagement;

use App\Helpers\AppHelper;
use App\Repositories\AssetRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class AssetService
{
    public function __construct(
        private AssetRepository $assetRepo
    ) {}

    public function getAllAssetsPaginated($filterParameters, $select = ['*'], $with = [])
    {
        if (AppHelper::ifDateInBsEnabled()) {
            $filterParameters['purchased_from'] = isset($filterParameters['purchased_from']) ?
                AppHelper::dateInYmdFormatNepToEng($filterParameters['purchased_from']) : null;
            $filterParameters['purchased_to'] = isset($filterParameters['purchased_to']) ?
                AppHelper::dateInYmdFormatNepToEng($filterParameters['purchased_to']) : null;
        }
        return $this->assetRepo->getAllAssetsPaginated($filterParameters, $select, $with);
    }

    public function findAssetById($id, $select = ['*'], $with = [])
    {
        try {
            $assetDetail =  $this->assetRepo->findAssetById($id, $select, $with);
            if (!$assetDetail) {
                throw new \Exception('Asset Type Not Found', 400);
            }
            return $assetDetail;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function saveAssetDetail($validatedData)
    {
        try {
            DB::beginTransaction();
            $assetDetail = $this->assetRepo->store($validatedData);
            DB::commit();
            return $assetDetail;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateAssetDetail($id, $validatedData)
    {
        try {
            $assetDetail = $this->findAssetById($id);
            DB::beginTransaction();
            $updateStatus = $this->assetRepo->update($assetDetail, $validatedData);
            DB::commit();
            return $updateStatus;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteAsset($id)
    {
        try {
            $assetDetail = $this->findAssetById($id);
            DB::beginTransaction();
            $status =  $this->assetRepo->delete($assetDetail);
            DB::commit();
            return $status;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function toggleAvailabilityStatus($id)
    {
        try {
            $assetDetail = $this->findAssetById($id);
            DB::beginTransaction();
            $status =  $this->assetRepo->changeIsAvailableStatus($assetDetail);
            DB::commit();
            return $status;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
