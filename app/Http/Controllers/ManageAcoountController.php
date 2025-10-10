<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Browsershot\Browsershot;

class ManageAcoountController extends Controller
{
    public function manage_account_page()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/get-devices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . config('services.fonnte.account_token'), // Get the token from the services config
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);

        $activeDeviceToken = null;

        if (!empty($data['data'])) {
            foreach ($data['data'] as $device) {
                if (($device['status'] ?? false) == 'connect') {
                    $activeDeviceToken = $device['token'];
                    break;
                }
            }
        }
        $roles = Role::select('rl_id', 'rl_name')->get();
        $accounts = User::with('roles')->paginate(10);
        return view('account.view', ['title' => 'Halaman Kelola Akun', 'accounts' => $accounts], compact('activeDeviceToken', 'roles'));
    }

    public function detail_account_page($id)
    {
        $account = User::withTrashed()->with('roles', 'created_by:usr_id,name', 'deleted_by:usr_id,name', 'updated_by:usr_id,name')->find($id);
        $role = Role::get();
        return view('account.detail', ['title' => 'Halaman Detail Akun', 'roles' => $role], compact('account'));
    }

    public function add_account_page()
    {
        $role = Role::select('rl_id', 'rl_name', 'rl_admin')->latest()->get();
        return view('account.add', ['title' => 'Halaman Tambah akun', 'roles' => $role]);
    }

    public function edit_account_page($id)
    {
        $account = User::where('usr_id', $id)->with('roles')->get();
        $roles = Role::get();
        return view('account.edit', ['title' => 'Halaman Ubah Akun', 'account' => $account, 'roles' => $roles]);
    }

    public function add_account_system(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required | min:3 | max:255',
            'usr_no_wa' => 'required  | unique:users,usr_no_wa| regex:/^[0-9]+$/ | phone:ID',
            'password' => 'required | min:5 | max:30 | confirmed',
            'usr_activation' => 'nullable | boolean',
            'usr_role_id' => 'required | exists:roles,rl_id',
            'image' => 'nullable|image|max:2048',
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('media/profile_img/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['usr_img_url'] = 'media/profile_img/' . $filename;
            $validateData['usr_img_public_id'] = $filename;
        }

        User::create($validateData);
        return redirect('/manage/account')->with('success', 'Akun Berhasil Dibuat');
    }

    public function edit_account_system(Request $request, $id)
    {
        $user = User::find($id);
        $validateData = $request->validate([
            'name' => 'sometimes | required | min:3 | max:255',
            'usr_activation' => 'sometimes | nullable | boolean',
            'usr_role_id' => 'sometimes | required | exists:roles,rl_id',
            'image' => 'sometimes | nullable|image|max:2048',
        ]);

        if ($request->usr_no_wa != $user['usr_no_wa']) {
            $no_wa = $request->validate([
                'usr_no_wa' => 'sometimes | required | regex:/^[0-9]+$/ | unique:users,usr_no_wa| phone:ID',
            ]);
            $validateData['usr_no_wa'] = $no_wa['usr_no_wa'];
        }

        if ($request->password != null) {
            $password = $request->validate([
                'password' => 'sometimes | nullable | min:5 | max:30 | confirmed',
            ]);
            $validateData['password'] = Hash::make($password['password']);
        }


        if ($request->hasFile('image')) {
            $destinationPath = public_path('media/profile_img/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move($destinationPath, $filename);

            $validateData['usr_img_url'] = 'media/profile_img/' . $filename;
            $validateData['usr_img_public_id'] = $filename;
        }

        $user->update($validateData);
        return redirect('/manage/account')->with('success', 'Akun Berhasil Diubah');
    }

    public function banned_account_system(Request $request, $id)
    {
        $user = User::find($id);

        $validateData = $request->validate([
            'usr_activation' => 'required | boolean',
        ]);

        $user->update($validateData);
        return redirect('/manage/account/' . $id . '/detail')->with('success', 'Akun Berhasil Diblokir');
    }

    public function activated_account_system(Request $request, $id)
    {
        $user = User::find($id);

        $validateData = $request->validate([
            'usr_activation' => 'required | boolean',
        ]);

        $user->update($validateData);
        return redirect('/manage/account/' . $id . '/detail')->with('success', 'Akun Berhasil Diaktifasi');
    }

    public function change_account_role_system(Request $request, $id)
    {
        $account = User::find($id);

        $validateData = $request->validate([
            'usr_role_id' => 'sometimes | required | exists:roles,rl_id',
        ]);

        $account->update($validateData);
        return redirect('/manage/account/' . $id . '/detail')->with('success', 'Berhasil Merubah Peran Akun');
    }

    public function delete_account_system(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/manage/account')->with('success', 'Akun Berhasil Dihapus');
    }

    public function print_card_system(Request $request) {
        $users = User::select('usr_id', 'name', 'usr_no_wa','usr_role_id', 'usr_created_at', 'usr_card_url')->with('roles')->where('usr_card_url', '!=', null)->where('usr_role_id', $request->role)->get();
        $path = storage_path('app/public/cards.pdf');
        $html = view('account.print_card', compact('users'))->render();
                Browsershot::html($html)
            ->showBackground()
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->save($path);
        return response()->download($path);
    }
}
