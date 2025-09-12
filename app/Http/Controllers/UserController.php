<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home_page() {
        return view('user.home', ['title' => 'Halaman Home']);
    }
}
