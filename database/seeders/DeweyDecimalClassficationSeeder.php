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
            ['ddc_code' => '1', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '2', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '3', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '4', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '5', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '6', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '221', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '297', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '303', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '323', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '420', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '495', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '499', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '510', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '621', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '700', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '745', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '796', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '959', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '2232', 'ddc_description' => '', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
        ]);
    }
}
