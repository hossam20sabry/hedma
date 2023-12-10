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
            <form class="d-flex" action="{{ route('admin.orders.search_code') }}" method="get" role="search">
                <input class="form-control me-2" name="search" type="search" placeholder="Search for code" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <div class="col-md-4 box_shadow p-3 my-1">
            <form class="d-flex" action="{{ route('admin.orders.search') }}" method="get" role="search">
                <input class="form-control me-2" name="search" type="search" placeholder="Search for Email" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</div>
@if ($orders->count() > 0)
<div class="container">
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <td class="text-center res_none">Name</td>
                <td class="text-center res_none">Email</td>
                <td class="text-center">Product</td>
                <td class="text-center">Quantity</td>
                <td class="text-center res_none">Payment</td>
                <td>Show</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="text-center res_none">{{$order->user->name}}</td>
                    <td class="text-center res_none">{{$order->user->email}}</td>
                    <td class="text-center">{{$order->product->name}}</td>
                    <td class="text-center">{{$order->quantity}}</td>
                    <td class="text-center res_none">{{$order->payment_status}}</td>
                    <td><a href="{{ route('admin.orders.show', $order->id)}}" class="btn btn-success">Show</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <div class="container">
        <h3 class="text-center">No Orders</h3>
    </div>
@endif
@endsection