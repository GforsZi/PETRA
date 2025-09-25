<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_page()
    {
        return view('auth.register', ['title' => 'Halaman Register']);
    }

    public function register_system(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required | min:3 | max:255',
            'usr_no_wa' => 'required | unique:users,usr_no_wa| phone:ID',
            'password' => 'required | min:5 | max:30 | confirmed',
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);
        return redirect('/login')->with('success', 'account created');
    }

    public function login_page()
    {
        return view('auth.login', ['title' => 'Halaman Login']);
    }

    public function login_system(Request $request)
    {
        $credentials = $request->validate([
            'usr_no_wa' => 'required | max:255',
            'password' => 'required | max:255',
        ]);

        if (FacadesAuth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = User::with('roles')->where('usr_no_wa', $credentials['usr_no_wa'])->get()->toArray();
            if ($user[0]['usr_activation'] == false || isset($user[0]['roles']) ) {
                return redirect()->intended('/home')->with('success', 'Login success!');
            } elseif($user[0]['usr_activation'] == true || $user[0]['roles']['rl_admin'] == "1") {
                return redirect()->intended('/dashboard')->with('success', 'Login success!');
            }else {
                return redirect()->intended('/forbidden')->with('success', 'Login success!');
            }
        }

        return back()->with('errorLogin', 'Login failed!');
    }

    public function logout_system(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
