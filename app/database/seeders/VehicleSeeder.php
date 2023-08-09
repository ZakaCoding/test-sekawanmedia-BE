<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'name' => 'Toyota Hilux',
                'plate_number' => 'N 8722 BE',
                'category' => 'company vehicle',
                'type' => 'transport',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Truck FUSO',
                'plate_number' => 'N 8212 EE',
                'category' => 'company vehicle',
                'type' => 'cargo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Toyota Avanza',
                'plate_number' => 'N 2222 FF',
                'category' => 'rental vehicle',
                'type' => 'transport',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Vehicle::insert($vehicles);
    }
}
