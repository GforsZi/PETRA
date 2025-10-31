<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class ManageRoleController extends Controller
{
    public function manage_role_page(Request $request)
    {
        $query = $request->get('s');
        $roles = Role::select('rl_id', 'rl_name', 'rl_description')
            ->where('rl_name', 'like', "%$query%")
            ->latest()
            ->paginate(10);
        return view('role.view', ['title' => 'Halaman kelola peran', 'roles' => $roles]);
    }

    public function detail_role_page($id)
    {
        $role = Role::withTrashed()->with('created_by', 'updated_by', 'deleted_by')->find($id);
        return view('role.detail', ['title' => 'Halaman detail peran'], compact('role'));
    }

    public function add_role_page()
    {
        return view('role.add', ['title' => 'Halaman tambah peran']);
    }

    public function edit_role_page(Request $request, $id)
    {
        $role = Role::where('rl_id', $id)->get();
        return view('role.edit', ['title' => 'Halaman ubah peran', 'role' => $role]);
    }

    public function add_role_system(Request $request)
    {

        $message = [
            'rl_name.required' => 'Nama peran wajib diisi.',
            'rl_name.min' => 'Nama peran minimal 3 karakter.',
            'rl_name.max' => 'Nama peran maksimal 255 karakter.',
            'rl_description.max' => 'Deskripsi peran terlalu panjang.',
            'rl_admin.boolean' => 'Status admin tidak valid.',
        ];

        $validateData = $request->validate([
            'rl_name' => 'required | string | min:3 | max:255',
            'rl_description' => 'nullable | string | max:255',
            'rl_admin' => 'nullable | boolean',
        ], $message);

        Role::create($validateData);
        return redirect('/manage/role')->with('success', 'peran berhasil ditambahkan');
    }

    public function edit_role_system(Request $request, $id)
    {
        $role = Role::find($id);

        $message = [
            'rl_name.required' => 'Nama peran wajib diisi.',
            'rl_name.min' => 'Nama peran minimal 3 karakter.',
            'rl_name.max' => 'Nama peran maksimal 255 karakter.',
            'rl_description.max' => 'Deskripsi peran terlalu panjang.',
            'rl_admin.boolean' => 'Status admin tidak valid.',
        ];

        $validateData = $request->validate([
            'rl_name' => 'sometimes | required | string | min:3 | max:255',
            'rl_description' => 'sometimes | nullable | string | max:65535',
            'rl_admin' => 'sometimes | nullable | boolean',
        ], $message);

        $role->update($validateData);
        return redirect('/manage/role')->with('success', 'peran berhasil diubah');
    }

    public function delete_role_system(Request $request, $id)
    {
        $role = Role::find($id);

        if ($role['rl_admin'] == true) {
            $admin = Role::select('rl_id')->where('rl_admin', true)->get()->count();
            if ($admin == 1) {
                return redirect('/manage/role')->with('error', 'peran admin tidak boleh terhapus semua');
            }
        }
        $role->delete();
        return redirect('/manage/role')->with('success', 'peran berhasil dihapus');
    }
}
