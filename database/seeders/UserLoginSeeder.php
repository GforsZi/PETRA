<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserLoginSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('user_logins')->insert([
            [
                'usr_lg_user_id' => null,
                'usr_lg_ip_address' => '192.168.1.10',
                'usr_lg_user_agent' => 'Mozilla/5.0 (Test)',
                'usr_lg_logged_in_at' => $now,
                'usr_lg_created_at' => $now,
                'usr_lg_updated_at' => $now,
                'usr_lg_sys_note' => 'Manual seed'
            ],
        ]);
    }
}
