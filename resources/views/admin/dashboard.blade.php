@extends('admin.layout')

@section('content') 
<div class="container my-4">
    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card box_shadow">
                <div class="card-body">
                    <h5 class="card-title">Today Revenue</h5>
                    <p class="card-text red">${{$totalPrice}}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3">
            <div class="card box_shadow">
                <div class="card-body">
                    <h5 class="card-title">Week Revenue</h5>
                    <p class="card-text red">${{$totalPriceWeek}}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3 ">
            <div class="card box_shadow">
                <div class="card-body">
                    <h5 class="card-title">Month Revenue</h5>
                    <p class="card-text red">${{$totalPriceMonth}}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3">
            <div class="card box_shadow">
                <div class="card-body">
                    <h5 class="card-title">Product Counter</h5>
                    <p class="card-text red">{{$product_count}}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3">
            <div class="card box_shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Orders Today</h5>
                    <p class="card-text red">{{$totalOrders}}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3">
            <div class="card box_shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Orders this week</h5>
                    <p class="card-text red">{{$totalOrdersWeek}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h4 class="text-center mt-3 mb-2 border-bottom p-2">Top 10 Products</h3>
    </div>
    <table class="table table-secondary">
        <thead>
            <tr>
                {{-- <th scope="col" class="res_none">id</th> --}}
                <th>image</th>
                <th scope="col">Name</th>
                <th scope="col" class="res_none">price</th>
                <th scope="col">sold</th>
                {{-- <th scope="col">brand</th> --}}
                <th scope="col" class="res_none">category</th>
                <th scope="col" class="res_none">kind</th>
                <th scope="col">Update</th>
                {{-- <th scope="col">Delete</th> --}}
                
            </tr>
        </thead>
        <tbody>
            @foreach ($topProducts as $product)
            <tr>
                    {{-- <th scope="row" class="res_none">{{$product->id}}</th> --}}
                    <td><img src="/images/{{$product->image}}" class="img_table_size" alt=""></td>
                    <td class="text-capitalize">{{$product->name}}</td>
                    <td class="res_none">${{$product->price}}</td>
                    <td>{{$product->times_sold}}</td>
                    {{-- <td>{{$product->brand->name}}</td> --}}
                    <td class="res_none" >{{$product->category->name}}</td>
                    <td class="res_none" >{{$product->kind->name}}</td>
                    <td><a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Update</a>
                    {{-- <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <td><button type="submit" class="btn btn-danger">Delete</button></td>
                    </form> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection