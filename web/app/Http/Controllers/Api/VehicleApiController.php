<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleApiController extends Controller
{
    // todo реализовать
    // Метод получает токен пользователя и выводит список его машин
    // с данными содержащими краткие сведения о машинах
    public function getAllVehicles(string $token) {
        return 'list of user\'s vehicles';
    }

    // Метод получает айди машины и токен пользователя и дает информацию об определенной машине
    public function getVehicle(int $id, $token) {
        return 'details of user\'s car';
    }
}
