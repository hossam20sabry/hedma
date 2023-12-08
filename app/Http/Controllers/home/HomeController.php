<?php

namespace App\Http\Controllers\home;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Stripe;

class HomeController extends Controller
{
    public function index(){
        $products = Product::inRandomOrder()->paginate(4);
        return view('home.index', compact('products'));
    }
    
}
