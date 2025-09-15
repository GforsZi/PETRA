<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dasboard_page() {
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('admin.dashboard', ['title' => 'Halaman Dasboard'], compact('user'));
    }

    public function profile_page() {
        $user = User::where('usr_id', Auth::user()->usr_id)->with('roles')->get()->first();
        return view('admin.profile', ['title' => 'Halaman Profile'], compact('user'));
    }
}
