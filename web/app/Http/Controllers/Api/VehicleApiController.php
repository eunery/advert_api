<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\CreateVehicleJob;
use App\Jobs\UpdateVehicleJob;
use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class VehicleApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAllVehicles() {

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
    public function getVehicle($id, $token) {

        $vehicle = Vehicle::where('id', $id)->first();

        return response()->json([$vehicle], 201);
    }

    /**
     * Create new user's vehicle
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createVehicle(Request $request) {
        $fields = $request->validate([
            'car_brand' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'other' => 'nullable|string',
            'issue_year' => 'required|integer',
            'image' => 'nullable|string',
            'plate_number' => 'nullable|string'
        ]);
        CreateVehicleJob::dispatch($fields);
        #return response()->json([$vehicle], 201);
    }

    /**
     * Update info about user's vehicle
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function updateVehicle(Request $request, $id){
        UpdateVehicleJob::dispatch($request, $id);
    }

    /**
     * Delete user's vehicle
     *
     * @return void
     */
    public function deleteVehicles() {

    }
}
