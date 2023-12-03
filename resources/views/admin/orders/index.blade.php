@extends('admin.layout')

@section('content') 
<div class="py-3 background">
    <div class="container">
        <div class="d-flex">
            <a href="{{ route('admin.orders.index') }}" class="decoration_none"><h3 class="m_r text-capatalize">Orders</h3></a>
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
    <div class="row center  mx-1">
        
        <div class="col-md-4 box_shadow p-3 my-1">
            <form class="d-flex" action="{{ route('admin.orders.search') }}" method="get" role="search">
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
                <td class="text-center">Name</td>
                <td class="text-center">Email</td>
                <td class="text-center">Product</td>
                <td class="text-center">Quantity</td>
                <td class="text-center">Payment</td>
                <td class="text-center">Delivery</td>
                <td >Notification</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="text-center">{{$order->user->name}}</td>
                    <td class="text-center">{{$order->user->email}}</td>
                    <td class="text-center">{{$order->product->name}}</td>
                    <td class="text-center">{{$order->quantity}}</td>
                    <td class="text-center">{{$order->payment_status}}</td>
                    @if ($order->delivery_status != 'pending')
                        <td class="text-center">Delivered</td>
                    @else
                    <td class="display-center">
                        <form action="{{ route('admin.orders.delivered') }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" value="{{$order->id}}" name="order_id">
                            <button class="btn btn-primary">Delivered</button>
                        </form>
                    </td>
                    @endif
                    <td><a href="" class="btn btn-success">Send Email</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection