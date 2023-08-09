<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CarAvailbilityController extends Controller
{
    public function index($type)
    {
        $data = Vehicle::where('type', $type)
                    ->where('status', 'available')
                    ->get();

        return response([
            'status' => true,
            'message' => 'debug',
            'data' => $data
        ]);
    }
}
