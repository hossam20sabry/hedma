<?php

namespace App\Http\Controllers\admin;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();


        return redirect()->back();
    }

    public function edit($id){
        $brand = Brand::find($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
        ]);
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->save();

        return redirect()->back()->with('message', 'brand updated successfully');
    }

    public function destroy($id){
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->back();
    }

    public function search(Request $request){
        $text = $request->text;
        $brands_result = Brand::where('name', 'LIKE' , "%$text%")->get();
        return view('admin.brands.search', compact('brands_result'));
    }
}
