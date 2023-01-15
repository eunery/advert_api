<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAllVehicles() {
        return response()->json(Vehicle::all());
    }

    // Метод получает айди машины и токен пользователя и дает информацию об определенной машине
    public function getVehicle(int $id, $token) {
        return 'details of user\'s car';
    }
}
