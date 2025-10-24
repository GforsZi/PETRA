<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookOriginSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('book_origins')->insert([
            [
                'bk_orgn_name' => 'BOS',
                'bk_orgn_created_at' => $now,
                'bk_orgn_updated_at' => $now,
                'bk_orgn_sys_note' => 'Manual seed',
            ],
        ]);
    }
}
