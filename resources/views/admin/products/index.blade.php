@extends('admin.layout')

@section('content') 
<div class="py-3 background">
    <div class="container">
        <div class="d-flex">
            <a href="{{ route('admin.products.index') }}" class="decoration_none"><h3 class="m_r text-capatalize">Product</h3></a>
        </div>
    </div>
</div>
<div class="container my-4">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @endif
</div>
<div class="container my-4 ">
    <div class="row center flex-space-between mx-1">
    
        <div class="col-md-4 box_shadow p-3 my-1">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary w-100 text-capitalize">add new product</a>
        </div>
        <div class="col-md-4 box_shadow p-3 my-1">
            <form class="d-flex" action="{{ route('admin.products.search') }}" method="get" role="search">
                
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th>image</th>
                <th scope="col">Name</th>
                <th scope="col">price</th>
                {{-- <th scope="col">description</th> --}}
                <th scope="col">brand</th>
                <th scope="col">category</th>
                <th scope="col">kind</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td><img src="/images/{{$product->image}}" class="img_table_size" alt=""></td>
                    <td class="text-capitalize">{{$product->name}}</td>
                    <td>${{$product->price}}</td>
                    {{-- <td>{{$product->description}}</td> --}}
                    <td>{{$product->brand->name}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->kind->name}}</td>
                    <td><a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Update</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <td><button type="submit" class="btn btn-danger">Delete</button></td>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection