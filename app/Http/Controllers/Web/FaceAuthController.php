<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FaceAuthController extends Controller
{
    public function index()
    {
        $employeeid = auth()->user()->id;
        return view('admin.faceauth.registerface.registerface', compact(['employeeid']));
    }
    

   

}
