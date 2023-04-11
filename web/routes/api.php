<?php

use App\Http\Controllers\Api\AdminApiController;
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

// default users
Route::group(['middleware' => ['auth:sanctum']], function () {

//     выход
    Route::post('/logout', [AuthApiController::class, 'logout']);

//     создание заказа
    Route::post('/orders', [OrderApiController::class, 'createOrder']);
//     удаление заказа
    Route::delete('/orders/{id}', [OrderApiController::class, 'deleteOrder']);
//     изменение заказа
    Route::put('orders/{id}', [OrderApiController::class, 'updateOrder']);
//     отправить на проверку выполнения условий
    Route::post('/orders/checkout', [OrderApiController::class, 'orderCheckout']);

//     получить машины пользователя
    Route::get('/profile/vehicles', [VehicleApiController::class, 'getAllVehicles']);
//     получение информации об определенной машине пользователя
    Route::get('/profile/vehicles/{id}', [VehicleApiController::class, 'getVehicle']);
//     создание транспорта пользователя
    Route::post('/profile/vehicles', [VehicleApiController::class, 'createVehicle']);
//     обновление транспорта пользователя
    Route::put('/profile/vehicles/{id}', [VehicleApiController::class, 'updateVehicle']);
//     удаление информации о машинах
    Route::delete('/profile/vehicles/{id}', [VehicleApiController::class, 'deleteVehicles']);

//    внутренняя информация об аккаунте пользователя
    Route::get('/profile', [UserApiController::class, 'getUserPrivateInfo']);
//    удалить аккаунт пользователя
    Route::delete('/profile', [UserApiController::class, 'deleteAccount']);
//     изменение сведений об аккаунте пользователя
    Route::put('/profile', [UserApiController::class, 'updateUser']);
//     показывает размещенные пользователем заказы, то есть которые он сам разместил
    Route::get('/profile/myOrders', [UserApiController::class, 'getPostedOrders']);
//     показывает действующие заказы пользователя, которые он принял на выполнение
    Route::get('/profile/active', [UserApiController::class, 'getActiveOrders']);
//     история выполненных заказов
    Route::post('/profile/history', [UserApiController::class, 'getOrderHistory']);



    Route::post('/auth', function (Request $request) {
        return response()->json(['message' => 'logged in', 'user' => auth()->user(), 'is_auth' => auth()->check()], 200);
    });
});

// admin
Route::group(['middleware' => ['auth:sanctum']], function () {

//    одобрить запрос на выполнение условий заказа
    Route::post('/admin/confirmOrder/{id}', [AdminApiController::class, 'confirmOrderCompletion']);
//    одобрить запрос на создание машины
    Route::post('/admin/confirmVehicle/{id}', [AdminApiController::class, 'confirmVehicle']);

});
// регистрация
Route::post('/register', [AuthApiController::class, 'register']);
// авторизация
Route::post('/login', [AuthApiController::class, 'login']);

// список всех заказов
Route::get('/orders', [OrderApiController::class, 'getAllOrders']);
// детали конкретного заказа
Route::get('/orders/{id}', [OrderApiController::class, 'getOrderById']);

// сведения об аккаунте пользователя
Route::get('/profile/{id}', [UserApiController::class, 'getUserById']);

Route::get('/test', function (Request $request) {
    print($request);
//    if (DB::connection()->getDatabaseName())  {
//        print(DB::connection()->getDatabaseName());
////        dd('Есть контакт!');
//    } else {
//        return 'Соединения нет';
//    }
});
