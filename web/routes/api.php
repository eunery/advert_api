<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\VehicleApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// PS Модели и контроллеры(и как я думаю много чего еще) создается через консоль, посмотри
/* todo надо подумать как реализовать модель заказчика и обычного пользователя
   может это будет одна модель User и допустим меняется переменная, либо пользователь
   может как создавать заказ так и принимать, если заполнил допольнительную информацию
*/

// список всех заказов todo реализовать вывод списка
Route::get('/orders', [OrderApiController::class, 'getAllOrders']);
// детали конкретного заказа todo реализовать логику получения данных о посте
Route::get('/order/{id}', [OrderApiController::class, 'getOrder']);

// список машин пользователя todo реализовать логику получения списка машин
Route::get('/vehicles', [VehicleApiController::class, 'getAllVehicles']);
// вывод определенной машины пользователя todo реализовать логику получения определенной машины
Route::get('/vehicle/{id}', [VehicleApiController::class, 'getVehicle']);


// авторизация todo реализовать логику авторизации / изменить метод
Route::post('/login', function () {
    return 'Login';
});
// регистрация todo реализовать логику регистрации / изменить метод
Route::post('/register', function () {
    return 'Login';
});
// выход todo реализовать логику выхода из аккаунта / изменить метод
Route::get('/logout', function () {
    return 'Logout';
});


