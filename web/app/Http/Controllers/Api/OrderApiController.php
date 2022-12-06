<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    // todo реализовать
    // Метод выводит все заказы, которые есть
    public function getAllOrders() {
        return 'list of orders';
    }

    // Метод выводит информацию о заказе
    public function getOrder(int $id) {
        return 'order details';
    }
}
