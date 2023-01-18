<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminApiController extends Controller
{
    /**
     * Confirm user's vehicle
     *
     * @param $id
     * @return JsonResponse
     */
    public function confirmVehicle($id) {

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

        DB::table('orders')
            ->where('id', '=', $id)
            ->update(['is_confirmed' => true]);
        DB::table('users')
            ->where('id', '=', $user->id)
            ->update(['balance' => $result]);

        return response()->json('confirmed terms');
    }
}
