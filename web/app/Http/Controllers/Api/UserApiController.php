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

    /**
     * Update information about user
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function updateUser(Request $request, User $user){
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * Get social information about user
     *
     * @param $id
     * @return JsonResponse
     */
    public function getUserById($id){

        $user = User::find($id);
        $response = [
            $user->password
        ];
        return response()->json($response, 302);
    }

    /**
     * Get private information about user
     *
     * @return JsonResponse
     */
    public function getUserPrivateInfo() {
        $id = auth()->user()->id;
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
