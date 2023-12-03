<?php

namespace App\Http\Controllers\admin;
use App\Models\Kind;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KindsController extends Controller
{
    public function index()
    {
        $kinds = Kind::all();
        return view('admin.kinds.index', compact('kinds'));
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $kind = new Kind();
        $kind->name = $request->name;
        $kind->save();


        return redirect()->back();
    }

    public function edit($id){
        $kind = Kind::find($id);
        return view('admin.kinds.edit', compact('kind'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
        ]);
        $kind = Kind::find($id);
        $kind->name = $request->name;
        $kind->save();

        return redirect()->back()->with('message', 'kind updated successfully');
    }

    public function destroy($id){
        $kind = Kind::find($id);
        $kind->delete();
        return redirect()->back();
    }

    public function search(Request $request){
        $text = $request->text;
        $kinds_result = Kind::where('name', 'LIKE' , "%$text%")->get();
        return view('admin.kinds.search', compact('kinds_result'));
    }
}
