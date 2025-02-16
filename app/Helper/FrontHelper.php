<?php


use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('userProfile')) {
    function userProfile()
    {
        return Auth::user();
    }
}
