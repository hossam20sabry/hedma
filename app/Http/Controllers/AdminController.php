<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;

class AdminController extends Controller
{
    public function index(){

        $startDateDay = Carbon::now()->startOfDay();
        $endDateDay = Carbon::now()->endOfDay();
        $totalPrice = Order::whereBetween('created_at', [$startDateDay, $endDateDay])->sum('total_price');

        $startDateWeek = Carbon::now()->startOfWeek();
        $endDateWeek = Carbon::now()->endOfWeek();
        $totalPriceWeek = Order::whereBetween('created_at', [$startDateWeek, $endDateWeek])->sum('total_price');

        $startDateMonth = Carbon::now()->startOfMonth();
        $endDateMonth = Carbon::now()->endOfMonth();
        $totalPriceMonth = Order::whereBetween('created_at', [$startDateMonth, $endDateMonth])->sum('total_price');

        $product = Product::all();
        $product_count =  count($product);

        $orders_startDateDay = Carbon::now()->startOfDay();
        $orders_endDateDay = Carbon::now()->endOfDay();
        $totalOrders = Order::whereBetween('created_at', [$orders_startDateDay, $orders_endDateDay])->count();
        
        $orders_startDateWeek = Carbon::now()->startOfWeek();
        $orders_endDateWeek = Carbon::now()->endOfWeek();
        $totalOrdersWeek = Order::whereBetween('created_at', [$orders_startDateWeek, $orders_endDateWeek])->count();

        $topProducts = Product::orderBy('times_sold', 'desc')->take(10)->get();
        return view('admin.dashboard', compact('totalPrice', 
        'totalPriceWeek', 'totalPriceMonth', 'product_count',
        'totalOrders', 'totalOrdersWeek', 'topProducts'));
    }

    public function login(){
        return view('admin.login');
    }

}
