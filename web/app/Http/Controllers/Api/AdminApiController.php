<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminApiController extends Controller
{
    /**
     * Confirm user's vehicle
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmVehicle($id) {

        DB::table('vehicles')
            ->where('id', '=', $id)
            ->update(['is_confirmed' => true]);
        return response()->json('confirmed vehicle');
    }

    public function confirmOrderCompletion($id) {

        DB::table('orders')
            ->where('id', '=', $id)
            ->update(['is_confirmed' => true]);

        return response()->json('confirmed terms');
    }
}
