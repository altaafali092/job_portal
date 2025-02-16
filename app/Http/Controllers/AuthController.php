<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'name' => 'required|max:50|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);
        $data = $request->all();
        $createUser = $this->create($data);
        toast('You are registered successfully','success');
        return redirect('login');
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
                toast('Login Successfull,','success');
                return redirect('/');
            }
        }

        return redirect('login')->withError('Login credentials are incorrect');
    }



    public function logout()
    {

        Auth::logout();
        toast('logout successful','success');
        return redirect('login');
    }


    public function profile(User $user)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.Auth.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'designation' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'phone' => $request->phone,
        ]);


        return back()->with('success', 'Profile updated successfully!');
    }


    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the uploaded file in 'public/profile_photos' and get its path
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_photos', 'public');

            // Delete the old image if it exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Update user's image path
            $user->update(['image' => $imagePath]);
        }

        return back()->with('success', 'Profile photo updated successfully!');
    }


    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}
