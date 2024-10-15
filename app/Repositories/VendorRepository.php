<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorRepository
{
    const IS_ACTIVE =1;
    public function getVendorByEmail($userEmail, $select = ['*'])
    {
        return Vendor::select($select)
            ->where('email', $userEmail)
            ->where('status', 1)
            ->first();
    }

    public function vendorLogin(Request $request)
    {
        $vendorByemail = self::getVendorByEmail($request->get('email'));
        if (!Hash::check($request->get('password'), $vendorByemail->password)) {
            return true;
        }
        return !Hash::check($request->get('password'), $vendorByemail->password);
       
    }

    public function store($validatedData)
    {
        $role_id = Role::where('slug', 'vendor')->value('id');
        $data = [
            'role_id' => $role_id,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
            'user_type' => User::VENDOR
        ];

        return User::create($data)->fresh();
    }
}
