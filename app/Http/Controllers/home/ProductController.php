<?php

namespace App\Http\Controllers\home;
use App\Models\Kind;
use App\Models\Product;
use App\Models\Order;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\Hedma;
use Notification;

class ProductController extends Controller
{
    public function index(){
        $products = Product::inRandomOrder()->paginate(20);
        $categories = Category::all();
        $brands = Brand::all();
        $kinds = Kind::all();
        return view("home.products.index",compact("products", "categories", "brands", "kinds"));
    }

    public function category($id){
        $category = Category::find($id);
        $products = $category->products()->get();
        $categories = Category::all();
        $brands = Brand::all();
        $kinds = Kind::all();
        return view("home.products.index",compact("products", "categories", "brands", "kinds"));
    }

    public function brand($id){
        $brand = Brand::find($id);
        $products = $brand->products()->get();
        $categories = Category::all();
        $brands = Brand::all();
        $kinds = Kind::all();
        return view("home.products.index",compact("products", "categories", "brands", "kinds"));
    }
    public function search(Request $request){
        $keyword = $request->search;
        $products = Product::where("name","like","%".$keyword."%")->get();
        $categories = Category::all();
        $brands = Brand::all();
        $kinds = Kind::all();
        return view("home.products.index",compact("products", "categories", "brands", "kinds"));
    }

    public function show($id){
        // $check = Order::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        // $order = new Order();
        $product = Product::find($id);
        $total_price = $product->price - $product->price * $product->discount / 100;
        $total_price = ceil($total_price);
        return view('home.products.show', compact('product', 'total_price'));
    }

    public function cash(Request $request){
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:6',
        ]);
        
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
        $order->save();

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

        $order->delivery_status = 'pending';
        $order->payment_status = 'cash_pending';
        $order->qr_code = uniqid().$order->id;
        $order->total_price = $request->total_price * $request->quantity;
        $order->save();

        $product = Product::find($request->product_id);
        $product->times_sold = $product->times_sold + $request->quantity;
        $product->quantity = $product->quantity - $request->quantity;
        $product->save();

        
        return redirect()->back()->with('success', 'Order confirmed Successfully, We will contact with you soon with more details, Thank you');
    }

}
