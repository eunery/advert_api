<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserApiController extends Controller
{

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function updateUser(Request $request, User $user){
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * @param $id
     * @return JsonResponse
     */

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
