<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function index(){
        return view('requirement.index');
    }

    public function manageRequirement(){
        return view('admin.requirement.index');
    }
}
