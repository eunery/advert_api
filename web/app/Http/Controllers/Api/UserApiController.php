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
     * Get user's accepted order history
     *
     * @return JsonResponse
     */
    public function getOrderHistory() {

        if (!auth()->check()) {
            return response()->json(['Unauthenticated'], 401);
        }
        $user = auth()->user();
        $response = DB::table('orders')
            ->where( 'user_accepted', '=', $user->id)
            ->where('is_active', '=', 'false')
            ->get();

        return response()->json([$response], 302);
    }

    /**
     * Get info about user's active orders
     *
     * @return JsonResponse
     */
    public function getActiveOrders() {

        $user = auth()->user();
        $active = DB::table('orders')
            ->where( 'user_accepted', '=', $user->id)
            ->where('is_active', '=', true)
            ->where('status', '=', 2)
            ->get();


        return response()->json($active, 302);
    }

    /**
     * Get posted orders by user
     *
     * @return JsonResponse
     */
    public function getPostedOrders(){

        $user = auth()->user();
        $posted = DB::table('orders')
            ->where('user_created', '=', $user->id)
            ->where('is_active', '=', 'true')
            ->get();

        return response()->json($posted, 302);
    }

    /**
     * Accept current order by user
     *
     * @param $id
     * @return JsonResponse
     */
    public function acceptOrder($id) {
        $user = auth()->user();
        DB::table('orders')
            ->where('id','=', $id)
            ->update(['user_accepted' => $user->id]);

        return response()->json('accepted order');
    }
}
