@extends('home.layout')

@section('index')
<div class="container p-2 mt-2">
    @if (Session::has('success'))
        <div class="alert alert-success text-center m-3">
            <p>{{ Session::get('success') }}</p> 
        </div>
    @endif
</div>
<div class="container p-2 mb-2 min_hei " id="Products">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6 ">
            <div class="card text-bg-light m-3 box_shadow p-2" style="max-width: 580px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/images/{{$order->product->image}}" class="img-fluid rounded-start p-2 productShow_img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"> <span class="text-capitalize text-bold">{{$order->product->name}}</span></h5>
                            <p class="card-text"> {{$order->product->description}}</p>
                            <p class="card-text"><span class="text-bold">Price:</span> <span class="text-decoration-line-through">${{$order->product->price}} </span> <span class="text-danger">&nbsp;&nbsp; ${{$order->product->price - $order->product->price * $order->product->discount / 100}}</span></p>
                            <p class="card-text"><span class="text-bold">Brand:</span> {{$order->product->brand->name}}</p>
                            <p class="card-text"><span class="text-bold">Code:</span> {{$order->qr_code}}</p>
                            
                            <div class="row pb-3">
                                <div class="col-md-6">
                                    <p class="card-text"><span class="text-bold">Quantity:</span> {{$order->quantity}}</p>
                                </div>
                                @if($order->delivery_status == 'delevered')
                                <div class="col-md-6">
                                    <p class="card-text green float-end"><span class="text-bold">Delivered</span></p>
                                </div>
                                @endif
                                @if($order->delivery_status == 'pending')
                                <div class="col-md-6">
                                    <p class="card-text text-primary float-end"><span class="text-bold">Pending</span></p>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="card-text"><span class="text-bold">Total Price:</span> <span class="red">${{$order->total_price}} </span></p>
                                </div>
                                <div class="col-md-6">
                                    @if($order->payment_status == 'canceled')
                                    <p class="card-text red float-end"><span class="text-bold">Order Canceled</p>
                                    @endif
                                    @if($order->delivery_status == 'pending')
                                    <form action="{{ route('orders.destroy', $order->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger float-end ">Cancel Order</button>
                                    </form>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    
</div>
@endsection
