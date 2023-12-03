@extends('home.layout')
@section('register')
<div class="container p-2 my-2 min_hei center" id="Products">
    <div class="row center">
        <div class="col-md-6 box_shadow">
            
            <form class="row g-3 text-bg-light p-2 m-3" action="{{ route('register') }}" method="POST">
                @csrf
                <h1 class="text-center">HEDMA</h1>
                <div class="col-md-12">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="Name" value="{{old('name')}}" autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}" autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="col-md-12">
                    <label for="Password" class="form-label">Password</label>
                    <input type="Password" name="password" class="form-control" id="Password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="col-md-12">
                    <label for="confirm_Password" class="form-label">Confirm Password</label>
                    <input type="Password" name="password_confirmation" class="form-control" id="confirm_Password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="col-12 center">
                    <button type="submit" class="btn btn-primary px-5">Register</button>
                </div>
            </form>
        </div>
    </div>
    
    
</div>
@endsection