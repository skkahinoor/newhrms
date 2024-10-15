<?php

namespace App\Http\Controllers\Web;

use App\Exports\AssetAssignmentListExport;
use Exception;
use App\Models\Asset;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AssetAssignment;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Services\AssetManagement\AssetService;
use App\Services\AssetManagement\AssetTypeService;
use App\Repositories\AssetAssignmentRepository;
use Maatwebsite\Excel\Facades\Excel;

class AssetAssignmentController extends Controller
{
    private $view = 'admin.assetManagement.assetAssignment.';

    public function __construct(
        private AssetTypeService $assetTypeService,
        private AssetService $assetService,
        private UserRepository $userRepo,
        private AssetAssignmentRepository $assetAsignmentRepo
    ) {
    }

    public function index(Request $request)
    {
        // dd($request->all());
        $this->authorize('list_type');
        try {
            $filterParameters = [
                'name' => $request->name ?? null,
                'assign_date' => $request->purchased_from ?? null,
                'return_date' => $request->purchased_to ?? null,
                'damaged' => $request->damaged ?? null,
                'type' => $request->type ?? null,
                'return_status' =>  $request->return_status ?? null,
                'download_excel' => $request->download_excel ?? null
            ];
            $select = ['*'];
            $with = ['assets', 'users', 'asset_types'];
            $assetType = $this->assetTypeService->getAllAssetTypes(['id', 'name']);
            $assetLists = $this->assetAsignmentRepo->getAllAssetAssignments($filterParameters,$select, $with);

            if ($filterParameters['download_excel']) {
                unset($filterParameters['download_excel']);
                return Excel::download(new AssetAssignmentListExport($filterParameters), 'Asset-assignment-report.xlsx');
            }

            return view($this->view . 'index', compact('assetLists','assetType','filterParameters'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function downloadAssignmentPDF()
    {
        $customers = [
            'name' => 'Jyotiranjan Sahoo',
            'address' => 'Bhubaneswar',
            'city' => 'Bhubaneswar',
            'state' => 'Odisha',
            'zip' => '751015',
            'phone' => '7609942076',
            'email' => 'jyotranjansahoo767@gmail.com'
        ];

        $items = [
            ['description' => 'Product 1', 'quantity' => 2, 'unit_price' => 25.00],
            ['description' => 'Product 2', 'quantity' => 1, 'unit_price' => 15.00],
            ['description' => 'Product 3', 'quantity' => 3, 'unit_price' => 10.00],
        ];

        $subtotal = collect($items)->sum(function ($item) {
            return $item['quantity'] * $item['unit_price'];
        });

        $amountPaid = 30.00; // Example amount paid
        $pdf = Pdf::loadView($this->view . 'pdf.assignmentAgreement', compact('customers', 'items', 'subtotal', 'amountPaid'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('Asset Assignment Agreement.pdf');
    }

    public function downloadReturnPDF()
    {
        $customers = [
            'name' => 'Jyotiranjan Sahoo',
            'address' => 'Bhubaneswar',
            'city' => 'Bhubaneswar',
            'state' => 'Odisha',
            'zip' => '751015',
            'phone' => '7609942076',
            'email' => 'jyotranjansahoo767@gmail.com'
        ];

        $items = [
            ['description' => 'Product 1', 'quantity' => 2, 'unit_price' => 25.00],
            ['description' => 'Product 2', 'quantity' => 1, 'unit_price' => 15.00],
            ['description' => 'Product 3', 'quantity' => 3, 'unit_price' => 10.00],
        ];

        $subtotal = collect($items)->sum(function ($item) {
            return $item['quantity'] * $item['unit_price'];
        });

        $amountPaid = 30.00; // Example amount paid
        $pdf = Pdf::loadView($this->view . 'pdf.returnAgreement', compact('customers', 'items', 'subtotal', 'amountPaid'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('Asset Retuned Agreement.pdf');
    }

    public function return(Request $request)
    {
        // dd($request->all());
        $id = $request->asset_assignment_id;
        $user_id = $request->user_id;
        $asset_id = $request->asset_id;
        $cost_of_damage = $request->cost_of_damage ? $request->cost_of_damage :  0;
        $amount_paid = $request->amount_paid != null ? $request->amount_paid :  null;
        $damage_reason = $request->damage_reason ? $request->damage_reason :  null;
        // dd($amount_paid);

        $q = AssetAssignment::where('id', $id)->where('user_id', $user_id)->where('asset_id', $asset_id);
        // dd($q->get()->toArray());

        if ($request->damage == 0 || $amount_paid == 1) {
            Asset::where('id', $asset_id)->update([
                'is_available' => 1
            ]);
        }

        if ($request->damage == 0) {
            $result = $q->update([
                'return_date' => date('Y-m-d', strtotime($request->return_date)),
                'returned' => 1,
                'damaged' => $request->damage,
                'cost_of_damage' => null,
                'return_status' => 1
            ]);
            return $this->index($request);
        } else {
            $result = $q->update([
                'return_date' => date('Y-m-d', strtotime($request->return_date)),
                'returned' => 1,
                'damaged' => $request->damage,
                'cost_of_damage' => $cost_of_damage,
                'paid' => $amount_paid,
                'damage_reason' => $damage_reason,
                'return_status' => $amount_paid == 1 ? 1 : 0,
            ]);
            return $this->index($request);
        }
    }

    public function create()
    {
        try {
            $employeeSelect = ['id', 'name'];
            $typeSelect = ['id', 'name'];

            $assets =  Asset::all(['id', 'name'])->toArray();
            $assetType = $this->assetTypeService->getAllActiveAssetTypes($typeSelect);
            $employees = $this->userRepo->getAllVerifiedEmployeeOfCompany($employeeSelect);
            return view($this->view . 'create', compact('assets', 'assetType', 'employees'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getAllAssetsByAssetTypeId($id)
    {

        $assets =  Asset::where('type_id', $id)->where('is_available', 1)->get(['id', 'name']);
        // dd($assets);
        if ($assets) {
            return response()->json([
                'data' => $assets
            ]);
        } else {
            return response()->json([
                'data' => null
            ]);
        }
    }

    public function store(Request $request)
    {
        // dd($request->asset);
        $this->authorize('create_assets');
        try {

            if ($request->asset == null) {
                return redirect()->route('admin.asset_assignment.index')->with('danger', "fields Can't be Empty");
            }
            $result = AssetAssignment::create([
                'asset_type_id' => $request->type_id,
                'asset_id' => $request->asset,
                'user_id' => $request->assigned_to,
                'assign_date' => $request->assign_date
            ]);
            if ($result) {
                Asset::where('id', $request->asset)->update([
                    'is_available' => 0
                ]);
                return redirect()->route('admin.asset_assignment.index')->with('success', 'Asset Assigned Successfully');
            } else {
                return redirect()->route('admin.asset_assignment.index')->with('error', 'Asset Assignment Failed');
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
