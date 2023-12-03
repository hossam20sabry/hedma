<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Kind;
use App\Models\Product;
use App\Models\Kinds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $kinds = Kind::all();
        return view('admin.products.create', compact('categories', 'brands', 'kinds'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'kind_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->kind_id = $request->kind_id;
        if($request->discount){
            $product->discount = $request->discount;
        }
        $product->quantity = $request->quantity;
        $image = $request->file('image');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $product->image = $image_name;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product created successfully');

    }

    public function edit($id){
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $kinds = Kind::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'kinds'));
    }

    public function update(Request $request, $id){
        $request -> validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'kind_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->kind_id = $request->kind_id;
        if($request->discount){
            $product->discount = $request->discount;
        }
        $product->quantity = $request->quantity;
        $image = $request->file('image');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $product->image = $image_name;
        }
        $product->save();

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function search(Request $request){
        $products = Product::where('name', 'like', '%' . $request->search . '%')->get();
        return view('admin.products.index', compact('products'));
    }
}
