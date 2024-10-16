<?php

namespace App\Http\Controllers\Web;

use App\Exports\AssetListExport;
use App\Http\Controllers\Controller;
use App\Models\AssetType;
use App\Models\User;
use App\Repositories\BrandRepository;
use App\Repositories\UserRepository;
use App\Services\AssetManagement\AssetService;
use App\Services\AssetManagement\AssetTypeService;
use App\Services\Vendors\VendorService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class VendorRegisterController extends Controller
{

    private $view = 'admin.procurement_request.';

    public function __construct(
        private VendorService $vendorService,
        private AssetService $assetService,
        private AssetTypeService $assetTypeService,
        private UserRepository $userRepo,
        private BrandRepository $brandRepo
    ) {}

    public function index(Request $request)
    {
        $this->authorize('list_assets');
        try {
            $filterParameters = [
                'name' => $request->name ?? null,
                'purchased_from' => $request->purchased_from ?? null,
                'purchased_to' => $request->purchased_to ?? null,
                'is_working' => $request->is_working ?? null,
                'is_available' => $request->is_available ?? null,
                'type' => $request->type ?? null,
                'download_excel' => $request->download_excel ?? null
            ];
            $select = ['*'];
            $with = ['type:id,name', 'assignedTo:id,name'];
            $assetType = $this->assetTypeService->getAllAssetTypes(['id', 'name']);
            $assetLists = $this->assetService->getAllAssetsPaginated($filterParameters, $select, $with);
            if ($filterParameters['download_excel']) {
                unset($filterParameters['download_excel']);
                return Excel::download(new AssetListExport($filterParameters), 'Asset-report.xlsx');
            }
            return view($this->view . 'index', compact('assetLists', 'assetType', 'filterParameters'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function viewRegistrationForm()
    {
        $assettype = AssetType::all();
        $vendoruser = User::all();
        return view('auth.vendorRegister', compact('assettype', 'vendoruser'));
    }

    public function getErrorMessage($data)
    {
        // dd($data,count($data));
        $message = [];
        foreach ($data as $key => $value) {
            $message[$key] = $value[0];
        }
        return $message;
    }
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $validatedData = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:25'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone' => ['required', 'numeric'],
                'password' => ['required', 'string', 'confirmed'],
                'asset-type' => ['required']
            ]);
            if ($validatedData->fails()) {
                // dd($validatedData->errors());
                return redirect()->back()->withErrors(self::getErrorMessage($validatedData->getMessageBag()->messages()));
            }
            // dd($validatedData);
            $this->vendorService->saveVendorDetails($request->all());

            return redirect()->route('admin.login');
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
