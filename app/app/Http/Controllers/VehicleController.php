<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function store(Request $request)
    {
        // validation request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'plate_number' => 'required|unique:vehicles',
        ]);

        if($validator->fails())
        {
            // return dd($validator->errors()->toArray());
            return redirect()->back()->with('errors', $validator->errors()->toArray());
        }

        // store data
        Vehicle::create($request->all());

        return redirect()->back()->with('success', "Success add new vehicle");
    }

    public function update($id, Request $request)
    {
        Vehicle::where('id', $id)
            ->update($request->except('_token'));

        return redirect()->back()->with('success', 'success update vehicle');
    }

    public function show($id)
    {
        $vehicle = Vehicle::where('id', $id)->first();

        $statistics = DB::table('rents')
                        ->where('vehicle_id', $id)
                        ->where('rents.status', 'done')
                        ->leftJoin('users','users.id','=', 'rents.user_id')
                        ->leftJoin('vehicles','vehicles.id','=', 'rents.vehicle_id')
                        ->leftJoin('drivers','drivers.id','=', 'rents.driver_id')
                        ->get([
                            'drivers.name AS name',
                            'rents.status AS status',
                            'rents.updated_at AS update_date',
                            'initial_miles',
                            'final_miles',
                            'fuel',
                        ]);

        return view('vehicle.detail', ['vehicle' => $vehicle, 'statistics' => $statistics]);
    }
}
