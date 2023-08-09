<?php

namespace App\Http\Controllers;

use App\Exports\RentExport;
use App\Models\Driver;
use App\Models\Rent;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Contracts\Service\Attribute\Required;

class RentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function store(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('errors', $validator->errors()->toArray());
        }

        // store
        $driver = Driver::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        $vehicle = Vehicle::where('id', $request->vehicle)->first(['id', 'miles']);

        try {
            Rent::create([
                'vehicle_id' => $vehicle->id,
                'driver_id' => $driver->id,
                'user_id' => $request->supervisor,
                'initial_miles' => $vehicle->miles,
            ]);

            // success
            Vehicle::where('id', $vehicle->id)->update([
                'status' => 'operational'
            ]);
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

        return redirect()->back()->with('success', 'Success make request car');
    }

    public function update($id, $status)
    {
        $rent = Rent::where('id', $id)->first(['vehicle_id', 'initial_miles', 'final_miles', 'fuel']);

        // update status
        try {
            Rent::where('id', $id)
                ->update([
                    'status' => $status
                ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }

        if($status == 'reject' || $status == 'done')
        {
            Vehicle::where('id', $rent['vehicle_id'])
                ->update([
                    'status' => 'available'
                ]);

            /**
             * [RULES]
             * when rent is done by driver
             * system will calculate total miles and fuels consumption
             * and update data vehicles
             * 
             */
            if($status == 'done')
            {
                // get vehicle data (miles, fuels)
                $vehicle = Vehicle::where('id', $rent->vehicle_id)->first(['id','miles', 'fuels']);

                try {
                    Vehicle::where('id', $rent->vehicle_id)
                        ->update([
                            'miles' => $vehicle->miles + ($rent->final_miles - $rent->initial_miles),
                            'fuels' => $vehicle->fuels + $rent->fuel,
                        ]);

                    // Success
                    // ... add to log or something
                } catch (\Exception $e) {
                    return redirect()->back()->with('errors', $e->getMessage());
                }
            }

        } else {
            Vehicle::where('id', $rent['vehicle_id'])
                ->update([
                    'status' => 'operational'
                ]);
        }

        return redirect()->back()->with('success', 'success update request');
    }

    public function updateVehicle($id, Request $request)
    {
        Rent::where('id', $id)
            ->update($request->except('_token'));

        return redirect()->back()->with('success-vehicle', 'Update Success');
    }

    public function show($id)
    {
        $rent = DB::table('rents')
                ->where('rents.id', $id)
                ->leftJoin('users','users.id','=','rents.user_id')
                ->leftJoin('drivers','drivers.id','=','rents.driver_id')
                ->leftJoin('vehicles','vehicles.id','=','rents.vehicle_id')
                ->first([
                    'rents.id',
                    'vehicles.name AS vehicle',
                    'vehicles.plate_number',
                    'vehicles.type',
                    'vehicles.category',
                    'rents.driver_id',
                    'rents.vehicle_id',
                    'rents.status AS status',
                    'initial_miles',
                    'final_miles',
                    'miles',
                    'fuel',
                    'drivers.name AS name',
                    'drivers.email',
                    'drivers.phone',
                    'drivers.address',
                    'rents.created_at AS created_at',
                ]);

        $latest = Rent::where('vehicle_id', $_GET['vehicle_id'])->latest('final_miles')->first('final_miles');

        if(is_null($rent))
        {
            return redirect()->back();
        }

        return view('rent.detail', ['rent' => $rent, 'latest' => $latest]);
    }

    public function export()
    {
        if(count(Rent::get()) == 0)
        {
            return redirect()->back();
        }

        return Excel::download(new RentExport, 'data-penggunaan-kendaraan.xlsx');
    }
}
