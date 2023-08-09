<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('errors', $validator->errors()->first());
        }

        try {
            Driver::where('id', $id)
                ->update($request->except(['_token', '_method']));

            return redirect()->back()->with('success', 'Success update driver');

        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }
}
