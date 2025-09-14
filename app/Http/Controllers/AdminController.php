<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dasboard_page() {
        return view('admin.dashboard', ['title' => 'Halaman Dasboard']);
    }

    public function profile_page() {
        return view('admin.profile', ['title' => 'Halaman Profile']);
    }
}
