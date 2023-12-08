@extends('home.layout')
@section('register')
<div class="container p-2 my-2 min_hei center">
    <div class="row center">
        <div class="col-10 col-md-5 box_shadow p-4">
            <form class="row g-3" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row center mt-2">
                        <img src="{{asset('home/img/logo-2.png')}}" class="logo-width float-end" alt="...">
                </div>
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
                    <label for="text" class="form-label">Address</label>
                    <input type="address" name="address" class="form-control" id="address" value="{{old('address')}}" autocomplete="username">
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" autocomplete="username">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
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
                    <button type="submit" class="btn btn-primary px-5 w-100">Register</button>
                </div>
                <div class="col-12 center">
                    <a href="{{ route('login') }}" class="btn btn-link">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>
    
    
</div>
<script>
    $(document).ready(function () {
        $('#phone').intlTelInput({
            initialCountry: 'auto',
            separateDialCode: true,
        });
    });
</script>
@endsection