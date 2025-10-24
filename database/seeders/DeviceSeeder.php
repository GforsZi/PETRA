<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder {
    public function run(): void {
        $now = Carbon::now()->toDateTimeString();

        DB::table('devices')->insert([
            [
                'dvc_name' => 'Android Phone',
                'dvc_device' => json_encode(['os' => 'Android', 'version' => '12']),
                'dvc_token' => 'token-example-1',
                'dvc_created_at' => $now,
                'dvc_updated_at' => $now,
                'dvc_sys_note' => 'Manual seed'
            ],
            [
                'dvc_name' => 'Web Client',
                'dvc_device' => json_encode(['browser' => 'Chrome', 'version' => '120']),
                'dvc_token' => 'token-example-2',
                'dvc_created_at' => $now,
                'dvc_updated_at' => $now,
                'dvc_sys_note' => 'Manual seed'
            ]
        ]);
    }
}
