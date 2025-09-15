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

    public function manage_chatbot_option_page() {
        return view('chat.option.view', ['title' => 'Halaman Kelola Opsi Chatbot']);
    }

    public function detail_chatbot_option_page($id) {
        return view('chat.option.detail', ['title' => 'Halaman Detail Opsi Chatbot']);
    }

    public function add_chatbot_option_page() {
        return view('chat.option.add', ['title' => 'Halaman Tambah Opsi Chatbot']);
    }

    public function add_chatbot_option_system(Request $request) {
        $validateData = $request->validate([
            'cht_opt_title' => 'required | string | max:255',
            'cht_opt_message' => 'required | string | max:255',
        ]);

        ChatOption::create($validateData);
        return redirect('/manage/chatbot/option')->with('success', 'opsi pesan Berhasil Ditambahkan');
    }

    public function edit_chatbot_option_page($id) {
        return view('chat.option.edit', ['title' => 'Halaman Ubah Opsi Chatbot']);
    }

    public function edit_chatbot_option_system(Request $request, $id) {
        $option = ChatOption::find($id);

        $validateData = $request->validate([
            'cht_opt_title' => 'sometimes | required | string | max:255',
            'cht_opt_message' => 'sometimes | required | string | max:255',
        ]);

        $option->update($validateData);
        return redirect('/manage/chatbot/option/' . $id . '/detail')->with('success', 'Opsi Pesan Berhasil Diubah');
    }

    public function manage_chatbot_notification_page() {
        return view('chat.notification.view', ['title' => 'Halaman Kelola Notifikasi']);
    }

    public function detail_chatbot_notification_page($id) {
        return view('chat.notification.detail', ['title' => 'Halaman Detail Notofikasi']);
    }

    public function add_chatbot_notification_page() {
        return view('chat.notification.add', ['title' => 'Halaman Tambah Notifikasi']);
    }

    public function add_chatbot_notification_system(Request $request) {
        $request->validate([
            'target'    => 'required|string',
            'message'   => 'required|string',
        ]);

        $target         = $request->input('target');
        $message        = $request->input('message');
        $deviceToken    = $request->input('device_token');

        $response = $this->fonnteService->sendWhatsAppMessage($target, $message, $deviceToken);

        if (!$response['status'] || (isset($response['data']['status']) && !$response['data']['status'])) {
            $errorReason = $response['data']['reason'] ?? 'Unknown error occurred';
            return response()->json(['message' => 'Error', 'error' => $errorReason], 500);
        }

        return response()->json([
            'message' => 'Pesan berhasil dikirim!',
            'data' => $response['data']
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

    public function manage_device_page() {
        return view('chat.device.view', ['title' => 'Halaman Kelola Perangkat']);
    }

    public function add_device_page() {
        return view('chat.device.add', ['title' => 'Halaman Tambah Perangkat']);
    }

    public function add_device_system(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'device' => 'required|string|max:255',
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
            return redirect()->back()->withInput()->with('error', $response->json()['reason'] ?? 'Unknown error occurred');
        }

        $response = $response->json();
        if (!$response['status']) {
            return redirect()->back()->withInput()->with('error', $response['reason'] ?? 'Failed to add device.');
        }

        Device::create([
            'dvc_name' => $validated['name'],
            'dvc_device' => $validated['device'],
            'dvc_token' => $response['token'] ?? null,
        ]);

        return redirect('/manage/device')->with('success', 'Device added successfully!');
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

        return response()->json([
            'status' => false,
            'error' => $response['error'] ?? 'Failed to activate the device.'
        ], 500);
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

    public function destroy_system($deviceId, Request $request)
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

    protected function request_OTP_for_delete_device_system($notificationId, $deviceId)
    {
        $device = Device::findOrFail($deviceId);
        $response = $this->fonnteService->requestOTPForDeleteDevice($device->token);

        if ($response['status']) {
            return response()->json(['message' => 'OTP berhasil dikirim!']);
        } else {
            return response()->json(['message' => 'Gagal mengirim OTP.', 'error' => $response['error']], 500);
        }
    }

    protected function submit_OTP_for_delete_device_system(Request $request, $deviceId)
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

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/get-devices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $accountToken,
            ),
        ));

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

        $response = $this->fonnteService->sendWhatsAppMessage(
            $request->input('target'),
            $request->input('message'),
            $deviceToken
        );

        if (!$response['status'] || (isset($response['data']['status']) && !$response['data']['status'])) {
            $errorReason = $response['data']['reason'] ?? 'Unknown error occurred';
            return response()->json(['message' => 'Error', 'error' => $errorReason], 500);
        }

        return response()->json(['message' => 'Pesan berhasil dikirim!', 'data' => $response['data']]);
    }
}
