<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\VehicleController;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/vehicle', function () {
    $vehicles = Vehicle::get();

    return view('vehicle', compact('vehicles'));
})->middleware(['auth', 'verified'])->name('vehicle');

Route::get(
    '/dashboard/vehicle/{id}', 
    [VehicleController::class, 'show']
)->middleware(['auth', 'verified'])->name('vehicle.detail');

// add new vehicle
Route::post(
    '/add/vehicle',
    [VehicleController::class, 'store']
)->middleware('auth')->name('vehicle.add');

Route::post(
    '/update/vehicle/{id}',
    [VehicleController::class, 'update']
)->middleware('auth')->name('vehicle.update');

/**
 * Update rent driver
 */
Route::post(
    'update/driver/{id}',
    [DriverController::class, 'update']
)->middleware('auth')->name('driver.update');

// rent
Route::get(
    '/request/vehicle/{id}',
    [RentController::class, 'show']
)->middleware('auth')->name('request.vehicle.detail');

Route::post(
    '/request/vehicle/update/{id}',
    [RentController::class, 'updateVehicle']
)->middleware('auth')->name('vehicle.update.rent');

Route::post(
    'request/vehicle/{id}/{status}',
    [RentController::class, 'update']
)->middleware('auth')->name('rent.done');

Route::post(
    '/request/vehicle',
    [RentController::class, 'store']
)->middleware('auth')->name('vehicle.request');

Route::get(
    'request/reject/{id}/{status}',
    [RentController::class, 'update']
)->middleware('auth')->name('vehicle.reject');

Route::get(
    'request/approve/{id}/{status}',
    [RentController::class, 'update']
)->middleware('auth')->name('vehicle.approve');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Export to Excel
Route::get(
    'rent/export',
    [RentController::class, 'export']
)->middleware('auth')->name('export.rent');

require __DIR__.'/auth.php';
