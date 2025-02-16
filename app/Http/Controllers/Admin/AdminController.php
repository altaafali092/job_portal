<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users=User::where('role','user')->latest()->get();
        $user=User::where('role','user')->count();
        return view('admin.index',compact('users','user'));
    }

}

