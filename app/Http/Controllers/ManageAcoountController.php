<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChatOption;
use App\Models\Role;
use App\Models\User;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Browsershot\Browsershot;

class ManageAcoountController extends Controller
{
    protected $fonnteService;

    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }
    public function manage_account_page(Request $request)
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
        $query = $request->get('s');
        $roles = Role::select('rl_id', 'rl_name')->get();
        $accounts = User::select('usr_id', 'name', 'usr_no_wa', 'usr_activation', 'usr_card_url', 'usr_role_id')
            ->with('roles')
            ->where('name', 'like', "%$query%")
            ->paginate(10);
        return view('account.view', ['title' => 'Halaman kelola akun', 'accounts' => $accounts], compact('activeDeviceToken', 'roles'));
    }

    public function detail_account_page($id)
    {
        $account = User::withTrashed()
            ->with([
                'roles',
                'login' => function ($query) {
                    $query->latest('usr_lg_logged_in_at');
                },
                'created_by:usr_id,name',
                'deleted_by:usr_id,name',
                'updated_by:usr_id,name',
            ])
            ->find($id);
        $role = Role::get();
        return view('account.detail', ['title' => 'Halaman detail akun', 'roles' => $role], compact('account'));
    }

    public function add_account_page()
    {
        $role = Role::select('rl_id', 'rl_name', 'rl_admin')->latest()->get();
        return view('account.add', ['title' => 'Halaman tambah akun', 'roles' => $role]);
    }

    public function edit_account_page($id)
    {
        $account = User::where('usr_id', $id)->with('roles')->get()->toArray();
        $roles = Role::get();
        return view('account.edit', [
            'title' => 'Halaman ubah akun',
            'account' => $account,
            'roles' => $roles,
        ]);
    }

    public function add_account_system(Request $request)
    {
        $message = [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama pengguna memiliki maksimal :max karakter.',
            'name.min' => 'Nama pengguna minimal harus memiliki :min karakter.',
            'usr_no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'usr_no_wa.unique' => 'Nomor WhatsApp sudah digunakan.',
            'usr_no_wa.regex' => 'Nomor WhatsApp hanya boleh berisi angka.',
            'usr_no_wa.phone' => 'Nomor WhatsApp tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.max' => 'Kata sandi memiliki maksimal :max karakter.',
            'password.min' => 'Kata sandi minimal harus memiliki :min karakter.',
            'password.confirmed' => 'Sandi dengan ulangin sandi harus sama.',
            'usr_activation.boolean' => 'Status aktivasi tidak valid.',
            'usr_role_id.required' => 'Peran pengguna wajib dipilih.',
            'usr_role_id.exists' => 'Peran yang dipilih tidak ditemukan.',
        ];

        $validateData = $request->validate([
            'name' => 'required | min:3 | max:255',
            'usr_no_wa' => 'required  | unique:users,usr_no_wa| regex:/^[0-9]+$/ | phone:ID',
            'password' => 'required | min:5 | max:30 | confirmed',
            'usr_activation' => 'nullable | boolean',
            'usr_role_id' => 'required | exists:roles,rl_id',
        ], $message);

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);
        return redirect('/manage/account')->with('success', 'Akun berhasil dibuat');
    }

    public function edit_account_system(Request $request, $id)
    {
        $user = User::find($id);

        $messageD = [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama pengguna memiliki maksimal :max karakter.',
            'name.min' => 'Nama pengguna minimal harus memiliki :min karakter.',
            'usr_activation.boolean' => 'Status aktivasi tidak valid.',
            'usr_role_id.required' => 'Peran pengguna wajib dipilih.',
            'usr_role_id.exists' => 'Peran yang dipilih tidak ditemukan.',
        ];

        $messageNo = [
            'usr_no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'usr_no_wa.unique' => 'Nomor WhatsApp sudah digunakan.',
            'usr_no_wa.regex' => 'Nomor WhatsApp hanya boleh berisi angka.',
            'usr_no_wa.phone' => 'Nomor WhatsApp tidak valid.',
        ];

        $messagePW = [
            'password.required' => 'Kata sandi wajib diisi.',
            'password.max' => 'Kata sandi memiliki maksimal :max karakter.',
            'password.min' => 'Kata sandi minimal harus memiliki :min karakter.',
            'password.confirmed' => 'Sandi dengan ulangin sandi harus sama.',
        ];

        $validateData = $request->validate([
            'name' => 'sometimes | required | min:3 | max:255',
            'usr_activation' => 'sometimes | nullable | boolean',
            'usr_role_id' => 'sometimes | required | exists:roles,rl_id',
        ], $messageD);

        if ($request->usr_no_wa != $user['usr_no_wa']) {
            $no_wa = $request->validate([
                'usr_no_wa' => 'sometimes | required | regex:/^[0-9]+$/ | unique:users,usr_no_wa| phone:ID',
            ], $messageNo);
            $validateData['usr_no_wa'] = $no_wa['usr_no_wa'];
        }

        if ($request->password != null) {
            $password = $request->validate([
                'password' => 'sometimes | nullable | min:5 | max:30 | confirmed',
            ], $messagePW);
            $validateData['password'] = Hash::make($password['password']);
        }

        $user->update($validateData);
        return redirect('/manage/account')->with('success', 'Akun berhasil diubah');
    }

    public function banned_account_system(Request $request, $id)
    {
        $user = User::find($id);

        $validateData = $request->validate([
            'usr_activation' => 'required | boolean',
        ]);

        $user->update($validateData);
        return redirect('/manage/account/' . $id . '/detail')->with('success', 'Akun berhasil diblokir');
    }

    public function activated_account_system(Request $request, $id)
    {
        try {
            $status_kode = null;
            $user = User::find($id);

            $validateData = $request->validate([
                'usr_activation' => 'required | boolean',
            ]);

            if ($request->send_wa == true) {
                $message = ChatOption::select('cht_opt_id', 'cht_opt_message', 'cht_opt_type')->where('cht_opt_type', '1')->get()->first()->toArray();

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
                    CURLOPT_HTTPHEADER => ['Authorization: ' . config('services.fonnte.account_token')],
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

                $request->validate([
                    'target' => 'required | exists:users,usr_no_wa| regex:/^[0-9]+$/ | phone:ID',
                ]);

                $deviceToken = $activeDeviceToken;

                if (str_starts_with($deviceToken, 'Bearer ')) {
                    $deviceToken = substr($deviceToken, 7);
                }

                $response = $this->fonnteService->sendWhatsAppMessage($request->target, $message['cht_opt_message'], $deviceToken);

                if (!$response['status'] || (isset($response['data']['status']) && !$response['data']['status'])) {
                    $errorReason = $response['data']['reason'] ?? 'Unknown error occurred';
                    return response()->json(['message' => 'Error', 'error' => $errorReason], 500);
                }

                $status_kode = response()->json([
                    'message' => 'pesan berhasil dikirim!',
                    'data' => $response['data'],
                ]);
            }

            $user->update($validateData);
            return redirect('/manage/account/' . $id . '/detail')->with('success', 'Akun berhasil diaktivasi ');
        } catch (\Throwable $th) {
            return redirect('/manage/account/' . $id . '/detail')->with('error', 'Akun gagal diaktivasi ');
        }
    }

    public function change_account_role_system(Request $request, $id)
    {
        $account = User::find($id);

        $validateData = $request->validate([
            'usr_role_id' => 'sometimes | required | exists:roles,rl_id',
        ]);

        $account->update($validateData);
        return redirect('/manage/account/' . $id . '/detail')->with('success', 'Berhasil merubah peran Akun');
    }

    public function delete_account_system(Request $request, $id)
    {
        try {

            $user = User::select('usr_id')->find($id);
            if ($user['usr_id'] == Auth::id()) {
                throw new \Exception('Tidak diizinkan menghapus akun yang sedang anda gunakan');
            }
            $user->delete();
            return redirect('/manage/account')->with('success', 'Akun berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('/manage/account')->with('error', 'Akun Gagal Dihapus');
        }
    }

    public function print_card_system(Request $request)
    {
        $request->validate([
            'role' => 'required|array',
            'role.*' => 'exists:roles,rl_id',
        ]);
        $users = User::select('usr_id', 'name', 'usr_no_wa', 'usr_role_id', 'usr_created_at', 'usr_card_url')
            ->with('roles')
            ->where('usr_card_url', '!=', null)
            ->whereIn('usr_role_id', $request->role)
            ->get();
        $path = storage_path('app/public/cards.pdf');
        $html = view('account.print_card', compact('users'))->render();
        Browsershot::html($html)->showBackground()->format('A4')->margins(10, 10, 10, 10)->save($path);
        return response()->download($path);
    }
}
