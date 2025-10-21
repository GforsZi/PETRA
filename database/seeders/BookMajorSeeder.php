<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookMajorSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('book_majors')->insert([
            [
                'bk_mjr_class' => 'X',
                'bk_mjr_major' => 'IPA',
                'bk_mjr_created_at' => $now,
                'bk_mjr_updated_at' => $now,
                'bk_mjr_sys_note' => 'Manual seed'
            ],
            [
                'bk_mjr_class' => 'XI',
                'bk_mjr_major' => 'IPS',
                'bk_mjr_created_at' => $now,
                'bk_mjr_updated_at' => $now,
                'bk_mjr_sys_note' => 'Manual seed'
            ],
            [
                'bk_mjr_class' => 'XII',
                'bk_mjr_major' => 'Bahasa',
                'bk_mjr_created_at' => $now,
                'bk_mjr_updated_at' => $now,
                'bk_mjr_sys_note' => 'Manual seed'
            ],
        ]);
    }
}
