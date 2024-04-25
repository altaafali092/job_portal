<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.Auth.login');
    }
    public function register()
    {
        return view('frontend.Auth.register');
    }
    public function registration(Request $request)
    {
        // dd ($request->all());
        $request->validate([
            'name' => 'required|max:50|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);
        $data = $request->all();
        $createUser = $this->create($data);
        return redirect('login')->withSuccess('You are registered successfully');

    }
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

   public function loginpost(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5',
    ]);

    $checkLoginCredentials = $request->only('email', 'password');

    if (Auth::attempt($checkLoginCredentials)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->withSuccess('Admin login successful');
        } else {
            return redirect('/')->withSuccess('User login successful');
        }
    }

    return redirect('login')->withError('Login credentials are incorrect');
}

    

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function profilepic()
    {
        return view ('frontend.Auth.profilepic');
    }
}
