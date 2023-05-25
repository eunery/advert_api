<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\CreateVehicleJob;
use App\Jobs\UpdateVehicleJob;
use App\Models\OrderImage;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleApiController extends Controller
{
    /**
     * Get user's confirmed vehicles
     *
     * @return JsonResponse
     */
    public function getAllVehicles()
    {
        $vehicles = Vehicle::where('user_id', auth()->user()->id)->where('is_confirmed', true)->get();
//        $vehicles = DB::table('vehicles')
//            ->where('user_id', '=', auth()->user()->id)
//            ->where('is_confirmed', '=', true)->get();
        return response()->json($vehicles, 200);
    }

    /**
     * Get user's vehicle
     *
     * @param $id
     * @param $token
     * @return JsonResponse
     */
    public function getVehicle($id)
    {

        $vehicle = Vehicle::where('id', $id)->first();

        return response()->json([$vehicle], 200);
    }

    /**
     * Create new user's vehicle
     *
     * @param Request $request
     * @return void
     */
    public function createVehicle(Request $request)
    {
        $fields = $request->validate([
            'car_brand' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'other' => 'nullable|string',
            'issue_year' => 'required|integer',
            'plate_number' => 'nullable|string',
        ]);

        $request->file('image')->store('test', 'public');
        $image_path = $request->file('image')->store('image/vehicles', 'public');
        $fields['image'] = $image_path;

        $user_id = Auth::id();

//        CreateVehicleJob::dispatch($fields, $user_id);
        $vehicle = Vehicle::create([
            'car_brand' => $fields['car_brand'],
            'model' => $fields['model'],
            'color' => $fields['color'],
            'other' => $fields['other'],
            'issue_year' => $fields['issue_year'],
            'plate_number' => $fields['plate_number'],
            'user_id' => $user_id
        ]);

        VehicleImage::create([
            'src' => $fields['image'],
            'vehicle_id' => $vehicle->id
        ]);
    }

    /**
     * Update info about user's vehicle
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function updateVehicle(Request $request, $id)
    {
//        UpdateVehicleJob::dispatch($request, $id);
        $data = $request->all();
        $vehicle = Vehicle::find($id);
        $vehicle -> update($data);
    }


    /**
     * Delete user's vehicle
     *
     * @param $id
     * @return Application|ResponseFactory|Response
     */
    public function deleteVehicles($id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle) {
            $vehicle->delete();
            return response('vehicle deleted', 200);
        } else
            return response(null, 404);
    }
}
