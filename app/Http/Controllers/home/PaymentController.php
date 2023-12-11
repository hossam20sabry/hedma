<?php

namespace App\Http\Controllers\home;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe;
use App\Notifications\Hedma;

use Illuminate\Support\Facades\Notification;
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


        // handling order
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->product_id = $request->product_id2;
        $order->quantity = $request->quantity2;
        $order->total_price = $request->total_price2 * $request->quantity2;
        $order->save();
        
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        
        $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';

        $response = $stripe->checkout->sessions->create([

            'success_url' => $redirectUrl . '&order_id=' . $order->id,

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


        return redirect($response['url']);
    }

    public function checkoutSuccess(Request $request){

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $order = Order::find($request->order_id);
        $order->delivery_status = 'pending';
        $order->payment_status = 'paid';
        $order->qr_code = uniqid() . '-' . $order->id;
        $order->save();

        // handling times_sold of product and quantity
        $product = Product::find($order->product_id);
        $product->times_sold = $product->times_sold + $request->quantity2;
        $product->quantity = $product->quantity - $request->quantity2;
        $product->save();

        $details = [
            'greeting' => 'Welcome to Hedma',
            'firstline' => 'your order has been successfully placed',
            'secondtline' => 'This is your order code: ' . $order->qr_code,
            'button' => 'View Order',
            'url' => route('orders.index', Auth::user()->id),
            'lastline' => 'Thank you for shopping with us',
        ];

        $user = Auth::user();

        Notification::send($user, new Hedma($details));

        $response = $stripe->checkout->sessions->retrieve($request->session_id);
        
        return view('home.payment_success');
    }
}
