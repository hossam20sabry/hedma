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
    @if(count($orders) == 0)
    <h2 class="text-center">No orders yet</h2>
    @else
    <table class="table box_shadow">
        <thead>
            <tr>
                {{-- <th scope="col">id</th> --}}
                <th>img</th>
                <th scope="col" class="res_none">Quantity</th>
                <th scope="col" >Total Price</th>
                <th scope="col" class="res_none">Delivery Status</th>
                <th scope="col">Show</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    {{-- <td>{{$order->id}}</td> --}}
                    <td><img src="{{'/images/'.$order->product->image}}" class="img-fluid rounded-start p-2 img-table" alt="..."></td>
                    <td class="res_none">{{$order->quantity}}</td>
                    <td>${{$order->total_price}}</td>
                    <td class="res_none">{{$order->delivery_status}}</td>
                    <td><a href="{{ route('orders.show', $order->id)}}" class="btn btn-success">Show</a></td>
                </tr>
            @endforeach
    </table>
    @endif
    
    
</div>
@endsection
