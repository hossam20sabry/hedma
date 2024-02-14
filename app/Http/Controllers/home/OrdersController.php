<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class OrdersController extends Controller
{

    public function orders($id)
    {
        $orders = Order::where('user_id', $id)->where('delivery_status', '!=', null)->where('payment_status', '!=', 'refunded')->get();
        return view('home.orders.index', compact('orders'));
    }

    public function destroy($id){
        $order = Order::find($id);
        $order->payment_status = 'canceled';
        $order->delivery_status = 'canceled';
        $order->update();
        return redirect()->back()->with('success', 'your Request to cancel this Order in under review now, we will contact you soon');
    }

    public function show($id){
        $order = Order::find($id);
        return view('home.orders.show', compact('order'));
    }
}
