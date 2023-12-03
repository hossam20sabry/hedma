@extends('home.layout')

@section('index')
<div class="main_img pos_relative">
    <div class="container">
        @if(Session::has('payment_success'))
            <div class="alert alert-danger">
                {{ Session::get('payment_success') }}
                @php
                    Session::forget('payment_success');
                @endphp
            </div>
        @endif
    </div>
    
    <img src="/home/img/main2.png" alt="...">
    <div class="content">
        <h2 class="hh1">Discover Your Style, Embrace Elegance. <br>Where Fashion Meets Passion.</h2>
        <a href="#Products" class="btn btn-info">Top-selling products</a>
    </div>
</div>

<div class="container p-2 my-2" id="Products">
    <div class="alert alert-success d-none">
        Product added to cart
    </div>
    <div class="alert alert-danger d-none">
        Product already in the cart
    </div>
    <div class="mainSpinner d-none" id="mainSpinner">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only"></span>
        </div>
    </div>
    <h1 class="text-center">Trending</h1>
    
    <div class="row center my-3">
        @foreach($products as $product)
        <div class="card my-2" style="width: 18rem;">
            <img src="/images/{{$product->image}}" class="card-img-top p-2" alt="...">
            <div class="card-body">
                <h5 class="card-title text-capitalize">{{$product->name}}</h5>
                <p class="card-text">Price: <span class="text-decoration-line-through">${{$product->price}}</span> <span class="text-danger">${{ceil($product->price - $product->price * $product->discount / 100)}}.00</span> 
                <br><span class="text-success text-capitalize">{{$product->brand->name}}</span></p>
                <div class="d-flex center">
                    @if(Auth::check())
                    @auth
                    <form action="" method="Post" class="add_to_cart">
                        @csrf
                        <input type="hidden" name="cart_id" value="{{Auth::user()->cart->id}}">                       
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                    @endauth
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Add to Cart</a>
                    @endif
                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-success">Order Now</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{$products->withQueryString()->links('pagination::bootstrap-4')}}
        </div>
    </div>

    

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
<script>
        
    $(document).ready(function(){

        $('.add_to_cart').on('submit', function(e){
            e.preventDefault();
            $('.alert-success').addClass('d-none');
            $('.alert-danger').addClass('d-none');
            $('#mainSpinner').removeClass('d-none');
            let formData = $(this).serialize();
            let exampleModal = $('#exampleModal');
            $.ajax({
                type: "POST",
                url: "{{ route('cart.add') }}",
                data: formData,
                success: function(response){
                    if(response.message == "success"){
                        $('.alert-success').removeClass('d-none');
                        $('#cart_num').text(response.num);
                        $('#mainSpinner').addClass('d-none');
                        $('html, body').animate({
                            scrollTop: $('#Products').offset().top
                        });
                    }

                    if(response.message == "duplicate"){
                        $('.alert-danger').removeClass('d-none');
                        $('#mainSpinner').addClass('d-none');
                        $('html, body').animate({
                            scrollTop: $('#Products').offset().top
                        });
                    }
                }
            });
            
        })
    })
</script>
@endsection