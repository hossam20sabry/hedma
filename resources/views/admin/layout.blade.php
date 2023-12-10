<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="/home/css/index.css">
    <link rel="icon" href="/home/img/shirt.png">
    <title>Hedma Dashboard</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container space_between">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <a href="{{ route('admin.categories.index') }}" class="nav-link text-capitalize">categories</a>
            <a href="{{ route('admin.brands.index') }}" class="nav-link text-capitalize">Brands</a>
            <a href="{{ route('admin.kinds.index') }}" class="nav-link text-capitalize">kinds</a>
            <a href="{{ route('admin.products.index') }}" class="nav-link text-capitalize">products</a>
            <a href="{{ route('admin.orders.index') }}" class="nav-link text-capitalize">orders</a>
            
            </ul>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-capitalize nav_item text-center box_shadow" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                        $userNameParts = explode(' ', Auth::guard('admin')->user()->name, 2);
                        $displayName = $userNameParts[0];
                    ?>
                    {{ $displayName }}
                </a>
                <ul class="dropdown-menu">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">log out</button>
                    </form>
                </ul>
            </div>
        </div>
        </div>
    </nav>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    
</body>
</html>