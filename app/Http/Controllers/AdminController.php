<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard_page()
    {
        $user = User::with('roles:rl_id,rl_name')->find(Auth::user()->usr_id);
        return view('admin.dashboard', ['title' => 'Halaman Dasboard'], compact('user'));
    }

    public function profile_page()
    {
        $user = User::where('usr_id', Auth::user()->usr_id)
            ->with('roles')
            ->get()
            ->first();
        return view('admin.profile', ['title' => 'Halaman Profile'], compact('user'));
    }
    public function profile_edit_page()
    {
        $user = User::select('usr_id', 'name', 'usr_bio', 'usr_img_url', 'usr_no_wa')->find(Auth::user()->usr_id);
        return view('admin.edit', ['title' => 'Halaman ubah Profile'], compact('user'));
    }

    public function edit_profile_system(Request $request)
    {
        $user = User::find(Auth::user()->usr_id);
        $validateData = $request->validate([
            'name' => 'sometimes | required | string | max:255',
            'usr_bio' => 'sometimes | nullable | string | max:255',
        ]);

        if ($request->usr_no_wa != $user['usr_no_wa']) {
            $no_wa = $request->validate([
                'usr_no_wa' => 'sometimes | required | regex:/^[0-9]+$/ | unique:users,usr_no_wa| phone:ID',
            ]);
            $validateData['usr_no_wa'] = $no_wa['usr_no_wa'];
        }

        $user->update($validateData);
        return redirect('/admin/profile')->with('success', 'Profile Berhasil Diubah');
    }
}
