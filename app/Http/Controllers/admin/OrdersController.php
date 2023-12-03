<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;


class OrdersController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view("admin.orders.index", compact("orders"));
    }

    public function search(Request $request){
        $product = User::where('email', $request->search)->first();
        $orders = Order::where('user_id', $product->id)->get();
        return view("admin.orders.index", compact("orders"));
    }

}
