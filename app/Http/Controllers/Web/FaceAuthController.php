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
    // Save facial data
    public function saveFaceDescriptor(Request $request)
    {
        $employeeid = auth()->user()->id;
        // $employee->face_descriptor = $request->input('descriptor');
        User::find($employeeid)->update([
            'face_descriptor' => $request->input('descriptor'),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Face registered successfully.']);
    }

    // Verify facial data
    public function verifyFace(Request $request)
    {
        $employee = auth()->user(); // Get logged-in user
        $storedDescriptor = json_decode($employee->face_descriptor);

        if (!$storedDescriptor) {
            return response()->json(['status' => 'error', 'message' => 'No facial data found.']);
        }

        $inputDescriptor = $request->input('descriptor');
        $distance = $this->calculateEuclideanDistance($storedDescriptor, $inputDescriptor);

        return response()->json([
            'status' => $distance < 0.6 ? 'success' : 'error',
            'message' => $distance < 0.6 ? 'Authentication successful' : 'Authentication failed',
            'distance' => $distance,
        ]);
    }

    // Get stored facial data
    public function getFaceDescriptor()
    {
        $employee = auth()->user();
        return response()->json($employee->face_descriptor);
    }

    // Euclidean distance calculation
    private function calculateEuclideanDistance($a, $b)
    {
        $distance = 0.0;
        for ($i = 0; $i < count($a); $i++) {
            $distance += pow($a[$i] - $b[$i], 2);
        }
        return sqrt($distance);
    }
}
