<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\CreateOrderJob;
use App\Jobs\GetOrdersJob;
use App\Jobs\UpdateOrderJob;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAllOrders(): JsonResponse
    {
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
     * @return void
     */
    public function createOrder(Request $request)
    {
        $fields = $request->validate([
            'tittle' => 'required|string',
            'location' => 'required|string',
            'price' => 'nullable|between:0,99.99',
            'payment_schedule' => 'required|string',
            'size' => 'required|string',
            'place' => 'nullable|string',
            'text' => 'nullable|string',
            'short_text' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $image_path = $request->file('image')->store('image/orders', 'public');
        $fields['image'] = $image_path;

        $user_id = Auth::id();

        CreateOrderJob::dispatch($fields, $user_id);
    }

    /**
     * @param Request $request
     * @param Int $id
     * @return void
     */

    public function updateOrder(Request $request, Int $id)
    {
        UpdateOrderJob::dispatch($request, $id);
    }

    /**
     * @param $id
     * @return Application|ResponseFactory|Response
     */

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response(null, 200);
        } else
            return response(null, 404);
    }

    /**
     * Do a checkout for order terms
     *
     * @return void
     */
    public function orderCheckout() {

    }
}
