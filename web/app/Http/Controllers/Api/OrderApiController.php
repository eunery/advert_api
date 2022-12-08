<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    public function getAllOrders(){
        return response()->json(Order::all());
    }

    public function getOrderById($id){
        return response()->json(Order::find($id));
    }

    public function createOrder(Request $request){
        $order = Order::create($request->all());
        return response()->json($order);
    }

    public function updateOrder(Request $request, $id){
        $order = Order::find($id);
        $order -> update($request->all());
        return response()->json($order);
    }

    public function deleteOrder($id){
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response(null, 200);
        }
        else
            return response(null, 404);
    }
}
