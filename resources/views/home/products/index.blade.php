@extends('home.layout')

@section('index')
<div class="py-3 background">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="nav-item dropdown m-1">
                        <a class="nav-link dropdown-toggle text-capitalize nav_item" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)
                                <li><a class="dropdown-item text-capitalize" href="{{ route('product.category', $category->id) }}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="nav-item dropdown m-1">
                        <a class="nav-link dropdown-toggle text-capitalize nav_item" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Brands
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($brands as $brand)
                                <li><a class="dropdown-item text-capitalize" href="{{ route('product.brand', $brand->id) }}">{{$brand->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-1">
                <form class="d-flex" action="{{ route('product.search') }}" method="get" role="search">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
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

    <h1 class="m-1 p-1 border-bottom">Products</h1>
    
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
        {{-- <div class="d-flex justify-content-center">
            {{$products->withQueryString()->links('pagination::bootstrap-4')}}
        </div> --}}
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

