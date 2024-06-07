<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::with('orderItems')->paginate();
        return OrderResource::collection($order);
    }

    public function show($id)
    {
        $order = Order::with('orderItems')->find($id);
        return new OrderResource($order);
    }
}
