<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Services\FonnteService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ChatOption;
use Illuminate\Support\Facades\Http;

class ManageChatbotController extends Controller
{
    protected $fonnteService;

    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }

    public function manage_chatbot_option_page()
    {
        $options = ChatOption::select('cht_opt_id', 'cht_opt_title')->latest()->paginate(10);
        return view('chat.option.view', ['title' => 'Halaman Kelola Opsi Chatbot'], compact('options'));
    }

    public function detail_chatbot_option_page($id)
    {
        $option = ChatOption::withTrashed()->with('created_by', 'updated_by', 'deleted_by')->find($id);
        return view('chat.option.detail', ['title' => 'Halaman Detail Opsi Chatbot'], compact('option'));
    }

    public function add_chatbot_option_page()
    {
        return view('chat.option.add', ['title' => 'Halaman Tambah Opsi Chatbot']);
    }

    public function add_chatbot_option_system(Request $request)
    {
        if ($request->cht_opt_type == '1') {
            $optionA = ChatOption::select('cht_opt_type')->where('cht_opt_type', '1')->get()->count();
            if ($optionA > 0) {
                return redirect('/manage/chat/option/add')->with('error', 'opsi "Pemberitahuan aktifasi" sudah tersedia');
                exit();
            }
        } elseif ($request->cht_opt_type == '2') {
            $optionB = ChatOption::select('cht_opt_type')->where('cht_opt_type', '2')->get()->count();
            if ($optionB > 0) {
                return redirect('/manage/chat/option/add')->with('error', 'opsi "Peringatan waktu peminjaman" sudah tersedia');
                exit();
            }
        }
        $validateData = $request->validate([
            'cht_opt_title' => 'required | string | max:255',
            'cht_opt_message' => 'required | string | max:255',
            'cht_opt_type' => 'required | in:1,2,3',
        ]);

        ChatOption::create($validateData);
        return redirect('/manage/chat/option')->with('success', 'opsi pesan Berhasil Ditambahkan');
    }

    public function edit_chatbot_option_page($id)
    {
        $option = ChatOption::select('cht_opt_id', 'cht_opt_title', 'cht_opt_message', 'cht_opt_type')->find($id);
        return view('chat.option.edit', ['title' => 'Halaman Ubah Opsi Chatbot'], compact('option'));
    }

    public function edit_chatbot_option_system(Request $request, $id)
    {
        $option = ChatOption::find($id);

        if ($request->cht_opt_type == '1') {
            $optionA = ChatOption::select('cht_opt_type')->where('cht_opt_type', '1')->get()->count();
            if ($request->cht_opt_type != $option['cht_opt_type'] && $optionA > 0) {
                return redirect('/manage/chat/option/' . $id . '/edit')->with('error', 'opsi "Pemberitahuan aktifasi" sudah tersedia');
                exit();
            }
        } elseif ($request->cht_opt_type == '2') {
            $optionB = ChatOption::select('cht_opt_type')->where('cht_opt_type', '1')->get()->count();
            if ($request->cht_opt_type != $option['cht_opt_type'] && $optionB > 0) {
                return redirect('/manage/chat/option/' . $id . '/edit')->with('error', 'opsi "Peringatan waktu peminjaman" sudah tersedia');
                exit();
            }
        }

        $validateData = $request->validate([
            'cht_opt_title' => 'sometimes | required | string | max:255',
            'cht_opt_message' => 'sometimes | required | string | max:255',
            'cht_opt_type' => 'required | in:1,2,3',
        ]);

        $option->update($validateData);
        return redirect('/manage/chat/option')->with('success', 'Opsi Pesan Berhasil Diubah');
    }

    public function delete_chatbot_option_system(Request $request, $id)
    {
        $option = ChatOption::find($id);
        $option->delete();
        return redirect('/manage/chat/option')->with('success', 'Opsi Pesan Berhasil Dihapus');
    }

    public function add_chatbot_notification_system(Request $request)
    {
        $request->validate([
            'target' => 'required|string',
            'message' => 'required|string',
        ]);

        $target = $request->input('target');
        $message = $request->input('message');
        $deviceToken = $request->input('device_token');

        $response = $this->fonnteService->sendWhatsAppMessage($target, $message, $deviceToken);

        if (!$response['status'] || (isset($response['data']['status']) && !$response['data']['status'])) {
            $errorReason = $response['data']['reason'] ?? 'Unknown error occurred';
            return response()->json(['message' => 'Error', 'error' => $errorReason], 500);
        }

        return response()->json([
            'message' => 'Pesan berhasil dikirim!',
            'data' => $response['data'],
        ]);
    }

    protected function validate_headers_system($authorizationHeader, $deviceToken)
    {
        if (empty($authorizationHeader)) {
            return response()->json(['message' => 'Authorization header is required'], 401);
        }

        if ($authorizationHeader != $deviceToken) {
            return response()->json(['message' => 'Invalid Device Authorization Token!'], 401);
        }

        return null;
    }

    public function manage_device_page()
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

        // Decode the response
        $data = json_decode($response, true);

        // Check if the response is successful
        if ($data['status']) {
            $devices = $data['data']; // Use the 'data' array from the response
        } else {
            $devices = []; // Handle error case
        }
        $devices_pg = Device::select('dvc_id', 'dvc_name', 'dvc_device')->latest()->paginate(10);
        return view('chat.device.view', ['title' => 'Halaman Kelola Perangkat'], compact('devices', 'devices_pg'));
    }

    public function add_device_page()
    {
        return view('chat.device.add', ['title' => 'Halaman Tambah Perangkat']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'device' => 'required|string|max:255|phone:ID',
        ]);

        $accountToken = config('services.fonnte.account_token');

        $response = Http::withHeaders([
            'Authorization' => $accountToken,
        ])->post('https://api.fonnte.com/add-device', [
            'name' => $validated['name'],
            'device' => $validated['device'],
            'autoread' => false,
            'personal' => true,
            'group' => false,
        ]);

        if ($response->failed()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $response->json()['reason'] ?? 'Unknown error occurred');
        }

        $response = $response->json();
        if (!$response['status']) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $response['reason'] ?? 'Failed to add device.');
        }

        Device::create([
            'dvc_name' => $validated['name'],
            'dvc_device' => $validated['device'],
            'dvc_token' => $response['token'] ?? null,
        ]);

        return redirect('/manage/chat/device')->with('success', 'Device added successfully!');
    }

    public function activate_device_system(Request $request)
    {
        $phoneNumber = $request->input('device');
        $deviceToken = $request->input('token');

        $response = $this->fonnteService->requestQRActivation($phoneNumber, $deviceToken);

        if ($response['status']) {
            return response()->json([
                'status' => true,
                'url' => $response['data']['url'],
            ]);
        }

        return response()->json(
            [
                'status' => false,
                'error' => $response['error'] ?? 'Failed to activate the device.',
            ],
            500,
        );
    }

    public function disconnect_system(Request $request)
    {
        try {
            $deviceToken = $request->input('token');
            $response = $this->fonnteService->disconnectDevice($deviceToken);

            if ($response['status'] === true) {
                return response()->json(['message' => 'Device disconnected successfully'], 200);
            }

            return response()->json(['error' => $response['error'] ?? 'Failed to disconnect device'], 500);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function destroy($deviceId, Request $request)
    {
        if ($request->otp) {
            $delete = $this->fonnteService->submitOTPForDeleteDevice($request->otp, $deviceId);

            if ($delete['status'] == false) {
                return response()->json(['message' => 'Terjadi kesalahan', 'error' => $delete['error']], 501);
            }

            return response()->json(['message' => 'Device berhasil dihapus']);
        }

        $requestToken = $this->fonnteService->requestOTPForDeleteDevice($deviceId);

        if ($requestToken['status'] == true) {
            return response()->json(['message' => 'Berhasil mengirim token']);
        }

        return response()->json(['message' => 'Gagal mengirim token', 'error' => $requestToken['error']], 500);
    }

    protected function requestOTPForDeleteDevice($notificationId, $deviceId)
    {
        $device = Device::findOrFail($deviceId);
        $response = $this->fonnteService->requestOTPForDeleteDevice($device->token);

        if ($response['status']) {
            return response()->json(['message' => 'OTP berhasil dikirim!']);
        } else {
            return response()->json(['message' => 'Gagal mengirim OTP.', 'error' => $response['error']], 500);
        }
    }

    protected function submitOTPForDeleteDevice(Request $request, $deviceId)
    {
        $device = Device::findOrFail($deviceId);
        $otp = $request->input('otp');

        Log::info('Mengirim OTP untuk menghapus perangkat', ['device_id' => $deviceId, 'otp' => $otp]);

        $response = $this->fonnteService->submitOTPForDeleteDevice($otp, $device->token);

        if ($response['status']) {
            $device->delete();
            Log::info('Perangkat berhasil dihapus dari sistem dan Fonnte', ['device_id' => $deviceId]);
            return response()->json(['message' => 'Perangkat berhasil dihapus!']);
        } else {
            Log::error('Gagal menghapus perangkat', ['error' => $response['error']]);
            return response()->json(['message' => 'Gagal menghapus perangkat.', 'error' => $response['error']], 500);
        }
    }

    public function check_device_status_system()
    {
        $accountToken = config('services.fonnte.account_token');
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/get-devices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Authorization: ' . $accountToken],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return response()->json(json_decode($response, true));
    }

    public function send_message_system(Request $request)
    {
        // Validasi input
        $request->validate([
            'target' => 'required|string',
            'message' => 'required|string',
        ]);

        $deviceToken = $request->header('Authorization');

        if (str_starts_with($deviceToken, 'Bearer ')) {
            $deviceToken = substr($deviceToken, 7);
        }

        $response = $this->fonnteService->sendWhatsAppMessage($request->input('target'), $request->input('message'), $deviceToken);

        if (!$response['status'] || (isset($response['data']['status']) && !$response['data']['status'])) {
            $errorReason = $response['data']['reason'] ?? 'Unknown error occurred';
            return response()->json(['message' => 'Error', 'error' => $errorReason], 500);
        }

        return response()->json(['message' => 'Pesan berhasil dikirim!', 'data' => $response['data']]);
    }

    public function show_quick_reply_system() {
        return response()->json(ChatOption::select('cht_opt_id', 'cht_opt_title')->get());
    }

    public function reply_system(Request $request) {
        $message = strtolower(trim($request->input('message')));
        $response = ChatOption::where('cht_opt_title', $message)->first();

        if ($response) {
            return response()->json(['reply' => $response->cht_opt_message]);
        }

        return response()->json(['reply' => 'Jika ada kendala yang belum dapat saya jawab, anda dapat menghubungi pustakawan untuk mendapatkan informasi lebih lanjut.']);
    }
}
