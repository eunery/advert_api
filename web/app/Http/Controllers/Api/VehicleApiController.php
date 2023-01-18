<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\CreateVehicleJob;
use App\Jobs\UpdateVehicleJob;
use App\Models\OrderImage;
use App\Models\Order;
use App\Models\Vehicle;
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
     * @return JsonResponse
     */
    public function getAllVehicles()
    {

        $vehicles = Vehicle::all();

        $response = [
            $vehicles
        ];
        return response()->json([$response], 201);
    }

    // Метод получает айди машины и токен пользователя и дает информацию об определенной машине

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

        return response()->json([$vehicle], 201);
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
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $image_path = $request->file('image')->store('image/vehicles', 'public');
        $fields['image'] = $image_path;

        $user_id = Auth::id();

        CreateVehicleJob::dispatch($fields, $user_id);
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
        UpdateVehicleJob::dispatch($request, $id);
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
            return response(null, 200);
        } else
            return response(null, 404);
    }
}
