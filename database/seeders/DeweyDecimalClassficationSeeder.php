<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeweyDecimalClassficationSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('dewey_decimal_classfications')->insert([
            ['ddc_code' => '100', 'ddc_description' => 'Filsafat & Psikologi', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '500', 'ddc_description' => 'Ilmu Pengetahuan Alam', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
        ]);
    }
}
