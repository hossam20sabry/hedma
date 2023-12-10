@extends('admin.layout')

@section('content')
<div class="py-3 background">
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.orders.index') }}" class="decoration_none"><h3 class="m_r text-capatalize">Orders</h3></a>
            <a href="{{ route('admin.orders.cancelRequests') }}" class="text-capitalize m-2 btn btn-danger">cancel requests</a>
        </div>
    </div>
</div>
<div class="container p-2 my-2 min_hei center">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-bg-light m-3 box_shadow p-2" style="max-width: 580px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/images/{{$order->product->image}}" class="img-fluid rounded-start p-2 productShow_img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"> <span class="text-capitalize">{{$order->product->name}}</span></h5>
                            <p class="card-text"> {{$order->product->description}}</p>
                            <p class="card-text"><span class="text-bold">User:</span> {{$order->user->name}}</p>
                            <p class="card-text"><span class="text-bold">Email:</span> {{$order->user->email}}</p>
                            <p class="card-text"><span class="text-bold">Total price:</span> ${{$order->total_price}}</p>
                            <p class="card-text"><span class="text-bold">Brand:</span> {{$order->product->brand->name}}</p>
                            <p class="card-text"><span class="text-bold">Category:</span> {{$order->product->category->name}}</p>
                            <p class="card-text"><span class="text-bold">Quantity:</span> {{$order->quantity}}</p>
                            <p class="card-text"><span class="text-bold">Payment status:</span> {{$order->payment_status}}</p>
                            <p class="card-text"><span class="text-bold">Delivery status:</span> {{$order->delivery_status}}</p>
                            <p class="card-text"><span class="text-bold">Code:</span> {{$order->qr_code}}</p>
                            @if($order->payment_status == 'canceled')
                            <div class="row mb-3">
                                <h4 class="text-center red"> Cancel Request</h4>
                            </div>
                            @endif
                            @if($order->delivery_status != 'delevered' && $order->payment_status != 'refunded')
                            <div class="row">
                                <div class="col-6">
                                    <a href="" class="btn btn-primary w-100">Email</a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.orders.cancel', $order->id) }}" class="btn btn-danger w-100">Cancel</a>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-12 mt-3">
                                    @if($order->delivery_status == 'pending')
                                    <a href="{{ route('admin.orders.delivered', $order->id) }}" class="btn btn-info w-100">Delevered</a>
                                    @endif
                                    @if($order->delivery_status == 'delevered')
                                    <h4 class="green text-center">Delevered</h4>
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