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
        return view('auth.register', ['title' => 'Halaman pendaftaran']);
    }

    public function register_system(Request $request)
    {
        $message = [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal harus memiliki 3 karakter.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'usr_no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'usr_no_wa.unique' => 'Nomor WhatsApp ini sudah terdaftar.',
            'usr_no_wa.regex' => 'Nomor WhatsApp hanya boleh berisi angka.',
            'usr_no_wa.phone' => 'Nomor WhatsApp tidak valid.',

            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 5 karakter.',
            'password.max' => 'Kata sandi maksimal 30 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai.',
        ];
        $validateData = $request->validate([
            'name' => 'required | min:3 | max:255',
            'usr_no_wa' => 'required  | unique:users,usr_no_wa| regex:/^[0-9]+$/ | phone:ID',
            'password' => 'required | min:5 | max:30 | confirmed',
        ], $message);

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);
        return redirect('/login')->with('success', 'akun berhasil dibuat');
    }

    public function login_page()
    {
        return view('auth.login', ['title' => 'Halaman masuk']);
    }

    public function login_system(Request $request)
    {
        try {

            $credentials = $request->validate([
                'usr_no_wa' => 'required | max:255',
                'password' => 'required | max:255',
            ]);

            if (FacadesAuth::attempt($credentials)) {
                $request->session()->regenerate();

                $user = User::with('roles')->where('usr_no_wa', $credentials['usr_no_wa'])->get()->toArray();
                if ($user[0]['usr_activation'] == false || isset($user[0]['roles'])) {
                    return redirect('/home')->with('success', 'Berhasil masuk');
                } elseif ($user[0]['usr_activation'] == true || $user[0]['roles']['rl_admin'] == '1') {
                    return redirect('/dashboard')->with('success', 'Berhasil masuk!');
                } else {
                    return redirect()->intended('/forbidden')->with('success', 'Berhasil masuk');
                }
            } else {
                throw new \Exception('Terjadi kesalahan pada input peminjaman');
            }
        } catch (\Throwable $th) {

            return redirect('/login')->with('error', 'Gagal masuk');
        }
    }

    public function logout_system(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
