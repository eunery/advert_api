<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdminApiController extends Controller
{
    /**
     * Get all not confirmed orders
     *
     * @return JsonResponse
     */
    public function notConfirmedOrders() {
        $orders = Order::where('is_confirmed', 0)->where('is_active', 1)->get();
        return response()->json($orders, 200);
    }

    public function notConfirmedVehicles() {
        $vehicles = Vehicle::where('is_confirmed', false)->get();
        return response()->json($vehicles, 200);
    }

    /**
     * Confirm user's vehicle
     *
     * @param $id
     * @return JsonResponse
     */
    public function confirmVehicle($id) {

        $vehicle = Vehicle::find($id);
//        $vehicle->is_confirmed = true;
        DB::table('vehicles')
            ->where('id', '=', $id)
            ->update(['is_confirmed' => true]);
        return response()->json('confirmed vehicle');
    }

    /**
     * Confirm order's terms and apply payment
     *
     * @param $id
     * @return JsonResponse
     */
    public function confirmOrderCompletion($id) {

        $order = Order::find($id);
        $user = User::find(auth()->id());
        $currentBalance = $user->balance;
        $result = $currentBalance + $order->price;

//        $order->is_confirmed = true;
//        $user->balance = $result;
//        $order->is_active = false;
        DB::table('orders')
            ->where('id', '=', $id)
            ->update(['is_confirmed' => true]);
        DB::table('users')
            ->where('id', '=', $user->id)
            ->update(['balance' => $result]);
        DB::table('orders')
            ->where('id', '=', $id)
            ->update(['is_active' => false]);

        return response()->json('confirmed terms');
    }

    /**
     * Send order to checkout for order terms
     *
     * @return Application|Response|ResponseFactory
     */
    public function orderCheckout($id) {
        $order = Order::find($id);
        $order->is_confirmed = 1;
        return response('order confirmed',200);
    }

    public function testUpload(Request $request) {
        $image_path = $request->file('image')->store('test', 'public');
        print($image_path);
        print(' ');
        print($request->file('image'));
        print(' ');
        dd($request);
    }
}
