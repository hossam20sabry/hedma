<?php

namespace App\Http\Controllers\home;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    public function show(Request $request){
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->product_id = $request->product_id2;
        $order->quantity = $request->quantity2;
        $order->delivery_status = 'pending';
        $order->total_price = $request->total_price2 * $request->quantity2;
        $order->save();
        return view('home.payment', compact('order'));
    }

    public function checkout(Request $request){

        $product = Product::find($request->product_id2);
        
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        
        $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';

        $response = $stripe->checkout->sessions->create([

            'success_url' => $redirectUrl,

            'customer_email' => 'demo@gmail.com',

            'payment_method_types' => ['link','card'],

            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' => 100 * $request->total_price2,
                        'currency' => 'USD',
                    ],
                    'quantity' => $request->quantity2
                ],
            ],

            'mode' => 'payment',
            'allow_promotion_codes' => true,
        ]);

        // handling order
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->product_id = $request->product_id2;
        $order->quantity = $request->quantity2;
        $order->delivery_status = 'pending';
        $order->payment_status = 'paid';
        $order->total_price = $request->total_price2 * $request->quantity2;
        $order->save();

        // handling times_sold of product and quantity
        $product->times_sold = $product->times_sold + $request->quantity2;
        $product->quantity = $product->quantity - $request->quantity2;
        $product->save();


        return redirect($response['url']);
    }

    public function checkoutSuccess(Request $request){

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        return view('home.payment_success');
    }
}
