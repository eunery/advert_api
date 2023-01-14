<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\CreateOrderJob;
use App\Jobs\GetOrdersJob;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAllOrders(): JsonResponse
    {
        #$orders = Order::all();
        #GetOrdersJob::dispatch($orders->toArray())->onQueue("OrdersQueue");
        return response()->json(Order::all());
    }

    /**
     * @param $id
     * @return JsonResponse
     */

    public function getOrderById($id): JsonResponse
    {
        return response()->json(Order::find($id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createOrder(Request $request){
        $order = Order::create($request->all());
        #CreateOrderJob::dispatch($request);
        return response()->json($order);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */

    public function updateOrder(Request $request, $id){
        $order = Order::find($id);
        $order -> update($request->all());
        return response()->json($order);
    }

    /**
     * @param $id
     * @return Application|ResponseFactory|Response
     */

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
