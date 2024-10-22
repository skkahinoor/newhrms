<?php

namespace App\Http\Controllers\Web;

use App\Exports\AssetAssignmentListExport;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Procurement;
use App\Repositories\AssetAssignmentRepository;
use App\Repositories\BrandRepository;
use App\Repositories\ProcurementRepository;
use App\Repositories\UserRepository;
use App\Requests\Procurement\ProcurementRequest;
use App\Services\AssetManagement\AssetService;
use App\Services\AssetManagement\AssetTypeService;
use App\Services\Procurement\ProcurementService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProcurementController extends Controller
{
    protected $view = 'admin.procurement.';

    public function __construct(
        private AssetTypeService $assetTypeService,
        private AssetService $assetService,
        // private ProcurementService $procurementService,
        private UserRepository $userRepo,
        private AssetAssignmentRepository $assetAsignmentRepo,
        private ProcurementRepository $procurementRepo,
        private ProcurementService $procurementService,
        private BrandRepository $brandRepo

    ) {}
    public function index(Request $request)
    {
        $this->authorize('view_procurement');
        try {
            $getUser = Auth::user();
            $getProcurement = Procurement::all();
            $filterParameters = [
                'procurement_number' => $request->procurement_number ?? null,
                'user_id' => $request->user_id,
                'email' => $request->email ?? null,
                'asset_type_id' => $request->asset_type_id ?? null,
                'quantity' => $request->quantity ?? null,
                'amount' => $request->amount ?? null,
                'request_date' => $request->request_date ?? null,
                'delivery_date' => $request->delivery_date ?? null,
                'brand_id' => $request->asset_type_id ?? null,
                'download_excel' => $request->download_excel ?? null,
            ];
           
            $select = ['*'];
            $with = ['users', 'asset_types', 'brands'];
            $assetType = $this->assetTypeService->getAllAssetTypes(['id', 'name']);
            $brands = $this->brandRepo->getBrandlist(['id', 'name']);
            $requests = $this->procurementRepo->getAllRequests($filterParameters, $select, $with);
            // dd($requests);
            
            if ($filterParameters['download_excel']) {
                unset($filterParameters['download_excel']);
                return Excel::download(new AssetAssignmentListExport($filterParameters), 'Asset-assignment-report.xlsx');
            }
            // dd($request->all());

            return view($this->view . 'index', compact('requests', 'assetType', 'filterParameters', 'brands', 'getProcurement'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        $this->authorize('create_procurement');
        try {
            $employeeSelect = ['id', 'name'];
            $typeSelect = ['id', 'name'];

            $assets = Asset::all(['id', 'name'])->toArray();
            $assetType = $this->assetTypeService->getAllActiveAssetTypes($typeSelect);
            $employees = $this->userRepo->getAllVerifiedEmployeeOfCompany($employeeSelect);
            $brands = $this->brandRepo->getBrandlist(['id', 'name']);
            $procurement_number = $this->procurementRepo->getProcruementNumber();

            return view($this->view . 'create', compact('brands', 'assets', 'assetType', 'employees', 'procurement_number'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function store(ProcurementRequest $request)
    {
        $this->authorize('create_procurement');
        try {
            $validated_data = $request->validated();
            $this->procurementService->storeProcurement($validated_data);
            return redirect()->route($this->view . 'index')->with('success', 'Request Added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorize('edit_procurement');
        // $this->authorize('edit_assets');
        try {
            $employeeSelect = ['id', 'name'];
            $typeSelect = ['id', 'name'];
            $brands = $this->brandRepo->getBrandlist(['id', 'name']);
            $assetType = $this->assetTypeService->getAllActiveAssetTypes($typeSelect);
            $employees = $this->userRepo->getAllVerifiedEmployeeOfCompany($employeeSelect);
            $procurementDetail = $this->procurementService->findProcurementById($id);
            return view($this->view . 'edit', compact('procurementDetail', 'assetType', 'employees', 'brands'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(ProcurementRequest $request, $id)
    {
        $this->authorize('edit_procurement');
        try {
            $validatedData = $request->validated();
            $this->procurementService->updateProcurement($id, $validatedData);
            return redirect()->route('admin.procurement.index')
                ->with('success', 'Request Updated Successfully');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage())
                ->withInput();
        }
    }

    public function delete($id)
    {
        $this->authorize('delete_procurement');
        try {
            DB::beginTransaction();
            $this->procurementService->deleteProcurementRequest($id);
            DB::commit();
            return redirect()->back()->with('success', 'Request Deleted Successfully');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $this->authorize('show_procurement');
        try {
            $select = ['*'];
            $with = ['asset_types:id,name', 'assignedTo:id,name'];
            $procurementDetails = $this->procurementService->findProcurementById($id, $select, $with, );

            return view('admin.procurement.show', compact('procurementDetails'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
