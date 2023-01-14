<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class VehicleApiController extends Controller
{
    /**
     * Get list of user's vehicles
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllVehicles(Request $request) {

        if (!auth()->check()) {
            return response()->json(['Unauthorized'], 401);
        }
        $vehicles = Order::all();

        $response = [
            $vehicles
        ];
        return response()->json([$response], 302);
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

        if (!auth()->check()) {
            return response()->json(['Unauthorized'], 401);
        }

        $vehicle = Order::where('id', $id)->first();

        return response()->json([$vehicle], 302);
    }

    /**
     * Create new user's vehicle
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createVehicle(Request $request) {

        if (empty($request->all())) {
            return response()->json(['message' => 'Empty credits'], 400);
        }

        $fields = $request->validate([
            'carBrand' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'other' => 'nullable|string',
            'issueYear' => 'required|integer',
            'image' => 'nullable|string'
        ]);

        $vehicle = Vehicle::create([
            'carBrand' => $fields['carBrand'],
            'model' => $fields['model'],
            'color' => $fields['color'],
            'other' => $fields['other'],
            'issueYear' => $fields['issueYear'],
            'image' => $fields['image']
        ]);


        return response()->json([$vehicle], 201);
    }



}
