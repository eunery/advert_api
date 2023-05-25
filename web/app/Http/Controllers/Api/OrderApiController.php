<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\CreateOrderJob;
use App\Jobs\GetOrdersJob;
use App\Jobs\UpdateOrderJob;
use App\Models\Order;
use App\Models\OrderImage;
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
     * Get all orders
     *
     * @return JsonResponse
     */
    public function getAllOrders(): JsonResponse
    {
        return response()->json(Order::where('user_accepted', null)->where('is_active', true)->get());
    }


    /**
     * Get order by id
     *
     * @param $id
     * @return JsonResponse
     */
    public function getOrderById($id): JsonResponse
    {
        return response()->json(Order::find($id));
    }

    /**
     * Create order
     *
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $image_path = $request->file('image')->store('image/orders', 'public');
        $fields['image'] = $image_path;

        $user_id = Auth::id();

//        CreateOrderJob::dispatch($fields, $user_id);
        $order = Order::create([
            'tittle' => $fields['tittle'],
            'location' => $fields['location'],
            'price' => $fields['price'],
            'payment_schedule' => $fields['payment_schedule'],
            'size' => $fields['size'],
            'place' => $fields['place'],
            'text' => $fields['text'],
            'short_text' => $fields['short_text'],
            'image' => $fields['image'],
            'user_created' => $user_id
        ]);

        OrderImage::create([
            'src' => $fields['image'],
            'order_id' => $order->id
        ]);
    }

    /**
     * Update order's credentials
     *
     * @param Request $request
     * @param Int $id
     * @return void
     */
    public function updateOrder(Request $request, Int $id)
    {
//        UpdateOrderJob::dispatch($request, $id);
        $data = $request->all();
        $order = Order::find($id);
        $order -> update($data);
    }

    /**
     * Delete order
     *
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
}
