@extends('home.layout')
@section('register')
<div class="container p-2 my-2 min_hei center">
    <div class="row center">
        <div class="col-10 col-md-5 box_shadow p-4">

            <form class="row g-3  p-2 " action="{{ route('login') }}" method="post">
                @csrf
                <div class="row center mt-2">
                    <img src="{{asset('home/img/logo-2.png')}}" class="logo-width float-end" alt="...">
                </div>
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
                    <button type="submit" class="btn btn-primary px-5 w-100">Log in</button>
                </div>
                <div class="col-md-12 center">
                    <a href="{{ route('register') }}" class="btn btn-link">Don't have an account? Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection