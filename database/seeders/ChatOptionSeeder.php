<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatOptionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('chat_options')->insert([
            [
                'cht_opt_title' => 'Tanya Jam Buka',
                'cht_opt_message' => 'Perpustakaan buka setiap hari Senin-Jumat 08:00-16:00',
                'cht_opt_type' => '3',
                'cht_opt_created_at' => $now,
                'cht_opt_updated_at' => $now,
                'cht_opt_sys_note' => 'Manual seed',
            ],
            [
                'cht_opt_title' => 'Cara Pinjam',
                'cht_opt_message' => 'Bawa kartu anggota dan identitas.',
                'cht_opt_type' => '3',
                'cht_opt_created_at' => $now,
                'cht_opt_updated_at' => $now,
                'cht_opt_sys_note' => 'Manual seed',
            ],
        ]);
    }
}
