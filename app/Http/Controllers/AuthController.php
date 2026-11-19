<?php
namespace App\Http\Controllers;
use App\Models\User;use Illuminate\Http\Request;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Hash;use Inertia\Inertia;
class AuthController extends Controller {
 public function login(){return Inertia::render('Auth/Login');}
 public function authenticate(Request $request){$credentials=$request->validate(['email'=>'required|email','password'=>'required']);if(!Auth::attempt($credentials,$request->boolean('remember')))return back()->withErrors(['email'=>'Email atau password salah.'])->onlyInput('email');$request->session()->regenerate();return redirect()->intended(route('shop.index'));}
 public function register(){return Inertia::render('Auth/Register');}
 public function store(Request $request){$data=$request->validate(['name'=>'required|string|max:120','email'=>'required|email|unique:users,email','password'=>'required|string|min:8|confirmed']);$user=User::create([...$data,'role'=>'customer']);Auth::login($user);$request->session()->regenerate();return redirect()->route('shop.index');}
 public function logout(Request $request){Auth::logout();$request->session()->invalidate();$request->session()->regenerateToken();return redirect()->route('shop.index');}
}
