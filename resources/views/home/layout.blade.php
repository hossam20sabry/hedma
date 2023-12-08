<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/home/css/index.css">
    <link rel="stylesheet" href="path/to/intl-tel-input/css/intlTelInput.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="path/to/intl-tel-input/js/intlTelInput.min.js"></script>
    <link rel="icon" href="/home/img/shirt.png">
    <title>Hedma</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg_primary">

        <div class="container">

            
            <a href="/">
                <img src="{{asset('home/img/logo-2.png')}}" class="logo-width2 float-end" alt="">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        @auth
                        <a class="nav-link" href="{{ route('orders.index', Auth::user()->id) }}">My Orders</a>
                        @endauth
                    </li>
                    <li class="nav-item">
                        @auth
                        <a class="nav-link" href="{{ route('cart.index', Auth::user()->cart->id) }}">
                        Cart[@if(Auth::user()->cart->products->count() > 0)
                        <span id="cart_num">{{Auth::user()->cart->products->count()}}</span>
                        @endif]</a>
                        @endauth
                    </li>
                    
                </ul>
                
                @if (Route::has('login'))
                @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-capitalize nav_item" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-capitalize" href="{{ route('profile.edit') }}">Profile</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li><button type="submit" class="dropdown-item text-capitalize">Log out</button></li>
                        </form>
                    </ul>
                </div>
                @else
                <div class="d-flex">   
                    <a class="btn btn-outline-light m-2" aria-current="page" href="{{ route('login') }}">Log in</a>
                    <a class="btn btn-light m-2" aria-current="page" href="{{ route('register') }}">Register</a>
                </div>  
                @endauth
                @endif
            </div>
        </div>
    </nav>  
    @yield('index')
    @yield('login')
    @yield('register')
    
    <footer class="bg_primary">
        <p class="text-center p-2">© 2023 Hedma. All rights reserved.</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>

    

</body>
</html>