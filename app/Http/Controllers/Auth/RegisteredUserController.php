<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Rules\PhoneValidationRule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('home.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', new PhoneValidationRule()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Cart::create([
            'user_id' => $user->id
        ]);

        event(new Registered($user));


        

        Auth::login($user);

        return redirect('/');

    }
}
