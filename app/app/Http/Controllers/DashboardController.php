<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $user = User::where('roles', 'supervisor')->get(['name', 'id']);
        $rent = DB::table('rents')
                    ->leftJoin('users','users.id','=','rents.user_id')
                    ->leftJoin('drivers','drivers.id','=','rents.driver_id')
                    ->leftJoin('vehicles','vehicles.id','=','rents.vehicle_id')
                    ->get([
                        'rents.id',
                        'vehicle_id',
                        'vehicles.name AS vehicle',
                        'vehicles.plate_number',
                        'vehicles.type',
                        'vehicles.category',
                        'rents.status AS status',
                        'drivers.name AS name',
                        'rents.created_at AS created_at'
                    ]);

        return view('dashboard', [
            'user' => $user,
            'rent' => $rent,
        ]);
    }
}
