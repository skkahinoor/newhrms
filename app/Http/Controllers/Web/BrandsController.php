<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    private $view = 'admin.assetManagement.brands.';

    public function __construct(
        private BrandRepository $brandrepo
    ) {
    }

    public function index()
    {
        $this->authorize('list_type');
        try {
            $select = ['*'];
            $with = ['assets'];
            $brandLists = $this->brandrepo->getBrandlist();
            return view($this->view . 'index', compact('brandLists'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        $this->authorize('create_type');
        try{
            return view($this->view.'create');
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function store(Request $request)
    {
        $this->authorize('create_type');
        try{

            $this->brandrepo->storeBrands($request->all());

            return redirect()->route('admin.brands.index')->with('success', 'Asset Type Created Successfully');
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorize('edit_type');
        try{
            $brandDetail = $this->brandrepo->findBrandById($id);
            return view($this->view.'edit', compact('brandDetail'));
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit_type');
        try{
            $brand_data = [
                'name' => $request->name
            ];
            $this->brandrepo->updateBrandDetails($id,$brand_data);
            return redirect()->route('admin.brands.index')
                ->with('success', 'Brand Detail Updated Successfully');
        }catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage())
                ->withInput();
        }
    }

    public function delete($id)
    {
        $this->authorize('delete_type');
        try{
            DB::beginTransaction();
                $this->brandrepo->deleteBrands($id);
            DB::commit();
            return redirect()->back()->with('success', 'Asset Type Deleted Successfully');
        }catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('danger',$exception->getMessage());
        }
    }

    public function toggleIsActiveStatus($id)
    {
        $this->authorize('edit_type');
        try{
            $this->brandrepo->toggleIsActiveStatus($id);
            return redirect()->back()->with('success', 'Status changed Successfully');
        }catch(\Exception $exception){
            return redirect()->back()->with('danger',$exception->getMessage());
        }
    }
    
}
