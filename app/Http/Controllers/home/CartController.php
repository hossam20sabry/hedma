<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartProduct;
use App\Models\Cart;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index($id){
        $cart = Cart::find($id);
        $products = $cart->products;
        return view('home.cart', compact('cart', 'products'));
    }

    public function cart_add(Request $request){
        // return response()->json($request->all());
        
        $check = CartProduct::where('cart_id', $request->cart_id)->where('product_id', $request->product_id)->first();

        if($check) return response()->json(['message' =>'duplicate']);
        
        $cart = Cart::find($request->cart_id);
        $cart->products()->syncWithoutDetaching($request->product_id); 
        $num = $cart->products->count();
        return response()->json(['message' => 'success', 'num' => $num]);
    }

    public function destroy_product(Request $request){
        $cart = Cart::find($request->cart_id);
        $cart->products()->detach($request->product_id);

        return redirect()->back()->with('message', 'Item deleted'); 
    }
}
