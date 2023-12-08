@extends('home.layout')

@section('index')
<div class="container min_hei center">
        <div class="my_card box_shadow">
            <div class="center p-2 mt-5">
                <img src="{{asset('home/img/check.png')}}" alt="" class="success_img m-2">
            </div>
            <h1 class="text-center p-2">Payment Successful</h1>
            <p class="text-center p-2">We will contact you soon with more details, <br> <span class="green text-bold">Thank you</span></p>
            <div class="center">
                <a href="{{route('orders.index', Auth::user()->id)}}" class="btn btn-success">My Orders</a>
            </div>
            </div>
            
</div>
@endsection