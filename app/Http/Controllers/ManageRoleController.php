<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class ManageRoleController extends Controller
{
    public function manage_role_page()
    {
        $roles = Role::select('rl_id', 'rl_name', 'rl_description')->latest()->paginate(10);
        return view('role.view', ['title' => 'Halaman Kelola Peran', 'roles' => $roles]);
    }

    public function detail_role_page($id)
    {
        $role = Role::withTrashed()->with('created_by', 'updated_by', 'deleted_by')->find($id);
        return view('role.detail', ['title' => 'Halaman Kelola Peran'], compact('role'));
    }

    public function add_role_page()
    {
        return view('role.add', ['title' => 'Halaman Tambah Peran']);
    }

    public function edit_role_page(Request $request, $id)
    {
        $role = Role::where('rl_id', $id)->get();
        return view('role.edit', ['title' => 'Halaman Ubah Peran', 'role' => $role]);
    }

    public function add_role_system(Request $request)
    {
        $validateData = $request->validate([
            'rl_name' => 'required | string | min:3 | max:255',
            'rl_description' => 'nullable | string | max:255',
            'rl_admin' => 'nullable | boolean',
        ]);

        Role::create($validateData);
        return redirect('/manage/role')->with('success', 'Peran Berhasil Ditambahkan');
    }

    public function edit_role_system(Request $request, $id)
    {
        $role = Role::find($id);
        $validateData = $request->validate([
            'rl_name' => 'sometimes | required | string | min:3 | max:255',
            'rl_description' => 'sometimes | nullable | string | max:65535',
            'rl_admin' => 'sometimes | nullable | boolean',
        ]);

        $role->update($validateData);
        return redirect('/manage/role')->with('success', 'Peran Berhasil Diubah');
    }

    public function delete_role_system(Request $request, $id)
    {
        $role = Role::find($id);

        if ($role['rl_admin'] == true) {
            $admin = Role::select('rl_id')->where('rl_admin', true)->get()->count();
            if ($admin == 1) {
                return redirect('/manage/role')->with('error', 'Peran Admin Tidak Boleh Terhapus Semua');
            }
        }
        $role->delete();
        return redirect('/manage/role')->with('success', 'Peran Berhasil Dihapus');
    }
}
