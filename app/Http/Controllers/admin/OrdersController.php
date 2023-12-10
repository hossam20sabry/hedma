<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Hedma;
use Notification;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller
{
    public function index(){
        $orders = Order::where('payment_status', '<>', 'canceled')->get();
        return view("admin.orders.index", compact("orders"));
    }

    public function search(Request $request){
        $product = User::where('email', $request->search)->first();
        if($product == null){
            return redirect()->back();
        }
        $orders = Order::where('user_id', $product->id)->get();
        return view("admin.orders.index", compact("orders"));
    }

    public function search_code(Request $request){
        $orders = Order::where('qr_code', $request->search)->get();
        return view("admin.orders.index", compact("orders"));
    }

    public function delivered($id){
        $order = Order::find($id);
        $order->delivery_status = 'delevered';
        $order->update();
        return redirect()->back();
    }

    public function show($id){
        $order = Order::find($id);
        return view("admin.orders.show", compact("order"));
    }

    public function cancelRequests(){
        $orders = Order::where('payment_status', 'canceled')->get();
        return view("admin.orders.index", compact("orders"));
    }

    public function cancel($id){
        $order = Order::find($id);
        $order->payment_status = 'refunded';
        $order->update();

        $details = [
            'greeting' => 'Welcome to Hedma',
            'firstline' => 'your request to cancel your order has been successfully completed, now your money has been refunded',
            'secondtline' => 'This is your order code: ' . $order->qr_code,
            'button' => 'View Order',
            'url' => route('orders.index', $order->user->id),
            'lastline' => 'Thank you for shopping with us',
        ];

        $user = User::find($order->user->id);

        Notification::send($user, new Hedma($details));

        return redirect()->back();
    }

    
}
