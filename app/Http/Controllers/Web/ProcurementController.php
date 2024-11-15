<?php

namespace App\Http\Controllers\Web;

use App\DataTables\ProcurementDataTable;
use App\Exports\AssetAssignmentListExport;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Procurement;
use App\Models\ProcurementItem;
use App\Models\Quotation;
use App\Models\Role;
use App\Models\User;
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
    public function index(Request $request,ProcurementDataTable $table)
    {
        $this->authorize('view_procurement');
        try {
            // $getUser = Auth::user();
            // $getUserId = $getUser->id;
            // $role = Role::where('slug','admin')->value('id');
            // // dd($getUserId);
            // $getProcurement = Procurement::all();
            // $filterParameters = [
            //     'procurement_number' => $request->procurement_number ?? null,
            //     'user_id' => $request->user_id,
            //     'email' => $request->email ?? null,
            //     'asset_type_id' => $request->asset_type_id ?? null,
            //     'quantity' => $request->quantity ?? null,
            //     'amount' => $request->amount ?? null,
            //     'request_date' => $request->request_date ?? null,
            //     'delivery_date' => $request->delivery_date ?? null,
            //     'brand_id' => $request->asset_type_id ?? null,
            //     'download_excel' => $request->download_excel ?? null,
            // ];
            // if (auth()->user()->role_id == $role) { // is Admin
            //     $isAdmin = true;
            //     // dd($getUser->id);
            //     $isUser = false;
            //     // $getRollId = $getUser->role_id;
            //     // dd($getRollId);
            //     // $rolesname = Role::whereIn('id', $getRollId)->pluck('slug');
            //     $select = ['*'];
            //     $with = ['users', 'asset_types', 'brands'];
            //     $where = ['user_id', $getUser->id];
            //     $assetType = $this->assetTypeService->getAllAssetTypes(['id', 'name']);
            //     $brands = $this->brandRepo->getBrandlist(['id', 'name']);
            //     // $requests = $this->procurementRepo->getAllRequests($filterParameters, $select, $with);
            //     $query = Procurement::with('users', 'asset_types', 'brands');
            //     $requests = $query->paginate(5);

            //     if ($filterParameters['download_excel']) {
            //         unset($filterParameters['download_excel']);
            //         return Excel::download(new AssetAssignmentListExport($filterParameters), 'Asset-assignment-report.xlsx');
            //     }
            // } else { // For other users
            //     $isAdmin = false;
            //     // dd($getUser->id);
            //     $isUser = true;
            //     $otheruser = User::where('id', $getUser->id)->first();
            //     $select = ['*'];
            //     $with = ['users', 'asset_types', 'brands'];
            //     $assetType = $this->assetTypeService->getAllAssetTypes(['id', 'name']);
            //     $brands = $this->brandRepo->getBrandlist(['id', 'name']);
            //     // $requests = $this->procurementRepo->getAllRequests($filterParameters, $select, $where, $with);
            //     $query = Procurement::where('user_id', $getUser->id)->with('users', 'asset_types', 'brands');
            //     $requests = $query->paginate(5);
            // }

            // return view($this->view . 'index', compact('requests', 'assetType', 'filterParameters', 'brands', 'getProcurement', 'isAdmin', 'isUser', 'getUserId'));
            return $table->render('admin.procurement.index');
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

    public function store(Request $request)
    {
        // dd($request->all());
        $this->authorize('create_procurement');
        $validatedData = $request->validate([
            'procurement_number' => 'required|string|max:255',
            'email' => 'required|email',
            'request_date' => 'required|date',
            'delivery_date' => 'required|date',
            'purpose' => 'nullable|string',
            'procurement_items' => ['required', 'string', function ($attribute, $value, $fail) {
                // Decode JSON to check for empty array
                $items = json_decode($value, true);
                if (empty($items)) {
                    $fail('You must add at least one procurement item');
                }
            }],
        ]);

        $procurement = Procurement::create([
            'user_id' => Auth::user()->id,
            'supervisor_id' => Auth::user()->supervisor_id,
            'procurement_number' => $validatedData['procurement_number'],
            'email' => $validatedData['email'],
            'request_date' => $validatedData['request_date'],
            'delivery_date' => $validatedData['delivery_date'],
            'purpose' => $validatedData['purpose'],
        ]);

        $procurementItems = json_decode($validatedData['procurement_items'], true);

        foreach ($procurementItems as $item) {
            $procurement->items()->create([
                'asset_type_id' => $item['asset_type_id'],
                'brand_id' => $item['brand_id'],
                'quantity' => $item['quantity'],
                'specification' => $item['specification'],
            ]);
        }

        return redirect()->route('admin.procurement.index')->with('success', 'Procurement created successfully.');
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

    public function update(Request $request, $id)
    {
        $this->authorize('edit_procurement');
    
        $validatedData = $request->validate([
            'procurement_number' => 'required|string|max:255',
            'email' => 'required|email',
            'request_date' => 'required|date',
            'delivery_date' => 'required|date',
            'purpose' => 'nullable|string',
            'procurement_items' => ['required', 'string', function ($attribute, $value, $fail) {
                $items = json_decode($value, true);
                if (empty($items)) {
                    $fail('You must add at least one procurement item.');
                }
            }],
        ]);
    
        try {
            // Step 1: Update main procurement details
            $procurement = Procurement::findOrFail($id);
            $procurement->update([
                'procurement_number' => $validatedData['procurement_number'],
                'email' => $validatedData['email'],
                'request_date' => $validatedData['request_date'],
                'delivery_date' => $validatedData['delivery_date'],
                'purpose' => $validatedData['purpose'],
            ]);
    
            // Step 2: Process procurement items
            $procurementItems = json_decode($validatedData['procurement_items'], true);
    
            // Collect existing item IDs for deletion check
            $existingItemIds = $procurement->items()->pluck('id')->toArray();
            $updatedItemIds = [];
    
            foreach ($procurementItems as $item) {
                if (isset($item['id']) && in_array($item['id'], $existingItemIds)) {
                    // Update existing item
                    $procurementItem = ProcurementItem::find($item['id']);
                    $procurementItem->update([
                        'asset_type_id' => $item['asset_type_id'],
                        'brand_id' => $item['brand_id'],
                        'quantity' => $item['quantity'],
                        'specification' => $item['specification'],
                    ]);
                    $updatedItemIds[] = $item['id'];
                } else {
                    // Create new item
                    $newItem = $procurement->items()->create([
                        'asset_type_id' => $item['asset_type_id'],
                        'brand_id' => $item['brand_id'],
                        'quantity' => $item['quantity'],
                        'specification' => $item['specification'],
                    ]);
                    $updatedItemIds[] = $newItem->id;
                }
            }
    
            // Step 3: Delete items not included in the update
            $itemsToDelete = array_diff($existingItemIds, $updatedItemIds);
            ProcurementItem::whereIn('id', $itemsToDelete)->delete();
    
            return redirect()->route('admin.procurement.index')->with('success', 'Procurement updated successfully.');
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', 'Error updating procurement: ' . $exception->getMessage());
        }
    }
    

    public function oldupdate(ProcurementRequest $request, $id)
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
            $requestAsset = ProcurementItem::where('procurement_id', $id)->get();

            return view('admin.procurement.show', compact('procurementDetails', 'requestAsset'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function changeStatus(Request $request, $status)
    {
        $procurements = Procurement::find($status)->update([
            'status' => 1,
        ]);

        // if ($procurement) {
        //     $procurement->status = 1;
        //     $procurement->save();

        //     return response()->json(['success' => true]);
        // }

        return response()->json($procurements);
    }

    public function pauseStatus(Request $request, $pstatus)
    {
        $procurement = Procurement::find($pstatus)->update([
            'status' => 4,
        ]);

        return response()->json($procurement);
    }

    public function resumeStatus(Request $request, $rstatus)
    {
        $procurement = Procurement::find($rstatus)->update([
            'status' => 1,
        ]);
        return response()->json($procurement);
    }

    public function getQuotationDetails($procurement_id)
    {
        $getquotation = Quotation::where('procurement_id', $procurement_id)->with(['vendor'])->get();
        // $isapproved = Quotation::where('procurement_id');
        return response()->json($getquotation);
    }

    public function approveStatusQuotation($id)
    {
        // $getapprove = Quotation::where('procurement_id', $id)->with(['vendor'])->get();
        $getapprove = Quotation::find($id);
        $getapprove->update([
            'is_approved' => 1,
        ]);
        return response()->json($getapprove);
    }

}
