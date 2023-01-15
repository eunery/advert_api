<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use http\Client\Curl\User;
use App\Models\Order;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserApiController extends Controller
{
    public function updateUser(Request $request, User $user){
        $user->update($request->all());
        return response()->json($user);
    }

    public function getUserById($id){
        return response()->json(User::find($id));
    }

    /**
     * Get user's order history
     *
     * @return JsonResponse
     */
    public function getOrderHistory() {

        if (!auth()->check()) {
            return response()->json(['Unauthenticated'], 401);
        }
        $user = auth()->user();
        $response = DB::table('orders')
            ->join('users', 'orders.user_accepted', '=', $user->id)
            ->where('isActive', '=', 'false')
            ->get();

        return response()->json([$response], 302);
    }

    public function getActiveOrders(Request $request) {

    }
}
