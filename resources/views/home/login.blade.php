@extends('home.layout')
@section('login')
<div class="container p-2 my-2 min_hei center" id="Products">

    <div class="row center">
        <div class="col-md-6 text-bg-light box_shadow p-5">

            <form class="row g-3  p-2 " action="{{ route('login') }}" method="post">
                @csrf
                <h1 class="p-2 m-3 text-center">HEDMA</h1>
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="col-md-12">
                    <label for="Password" class="form-label">Password</label>
                    <input type="Password" name="password" class="form-control" id="Password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                
                <div class="col-md-12 center">
                    <button type="submit" class="btn btn-primary px-5">Log in</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection