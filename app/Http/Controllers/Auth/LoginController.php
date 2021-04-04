<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
          if(Auth::user()->status === "ACTIVE"){
            return redirect()->route('home');
          }
          return back()->with('danger','Your Account is Locked..please contact the Administrator');
        }
        return back()->with('danger','Invalid Username Or Password');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
