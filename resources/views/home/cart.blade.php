@extends('home.layout')
@section('index')
<div class="container min_hei p-2 my-2">
    @if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="row center my-3">
        @if(count($products) > 0)
        @foreach($products as $product)
        <div class="card my-2" style="width: 18rem;">
            <img src="/images/{{$product->image}}" class="card-img-top p-2" alt="...">
            <div class="card-body">
                <h5 class="card-title text-capitalize">{{$product->name}}</h5>
                <p class="card-text">Price: <span class="text-decoration-line-through">${{$product->price}}</span> <span class="text-danger">${{$product->price - $product->price * $product->discount / 100}}</span> 
                <br><span class="text-success text-capitalize">{{$product->brand->name}}</span></p>
                <div class="d-flex center">
                    <form action="{{ route('cart.destroy_product') }}" method="Post" class="add_to_cart">
                        @csrf
                        <input type="hidden" name="cart_id" value="{{Auth::user()->cart->id}}">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button type="submit" class="btn btn-danger text-capitalize">remove item</button>
                    </form>
                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-success text-capitalize">Order Now</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <h3 class="text-center">No Products added to your cart</h3>
        @endif
    </div>

    
</div>
@endsection