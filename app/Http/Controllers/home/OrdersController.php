<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class OrdersController extends Controller
{

    public function orders($id)
    {
        $orders = Order::where('user_id', $id)->get();
        return view('home.orders.index', compact('orders'));
    }

    public function destroy($id){
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted successfully');
    }
}
