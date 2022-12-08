<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\OrderApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
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

Route::group(['middleware' => ['auth:sanctum']], function (){
    // создание заказа
    Route::post('/orders', [OrderApiController::class, 'createOrder']);

    // удаление заказа
    Route::delete('/orders/{id}', [OrderApiController::class, 'deleteOrder']);

    // изменение заказа
    Route::put('orders/{id}', [OrderApiController::class, 'updateOrder']);

    // выход
    Route::post('/logout', [AuthApiController::class, 'logout']);
});

// список всех заказов
Route::get('/orders', [OrderApiController::class, 'getAllOrders'])  ;

// детали конкретного заказа
Route::get('/orders/{id}', [OrderApiController::class, 'getOrderById']);

// список машин пользователя todo реализовать логику получения списка машин
Route::get('/vehicles', [VehicleApiController::class, 'getAllVehicles']);

// вывод определенной машины пользователя todo реализовать логику получения определенной машины
Route::get('/vehicle/{id}', [VehicleApiController::class, 'getVehicle']);


// регистрация
Route::post('/register', [AuthApiController::class, 'register']);

// авторизация
Route::post('/login', [AuthApiController::class, 'login']);

Route::get('/users/{id}', [UserApiController::class, 'getUserById']);

Route::put('/users/{user}', [UserApiController::class, 'updateUser']);

Route::get('/test', function() {
    if (DB::connection()->getDatabaseName())  {
        print(DB::connection()->getDatabaseName());
//        dd('Есть контакт!');
    } else {
        return 'Соединения нет';
    }});



