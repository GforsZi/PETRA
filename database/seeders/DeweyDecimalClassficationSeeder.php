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
            ['ddc_code' => '001.6', 'ddc_description' => 'Ilmu komputer & sistem informasi', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '004.6', 'ddc_description' => 'Jaringan komputer & komunikasi data', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '005.1', 'ddc_description' => 'Pemrograman komputer', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '005.33', 'ddc_description' => 'Basis data & manajemen data', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '005.8', 'ddc_description' => 'Keamanan informasi & kriptografi', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '1', 'ddc_description' => 'Filsafat & psikologi', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '4', 'ddc_description' => 'Bahasa', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '5', 'ddc_description' => 'Ilmu alam & matematika', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '221', 'ddc_description' => 'Alkitab (studi & interpretasi)', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '297', 'ddc_description' => 'Agama Islam', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '303.3', 'ddc_description' => 'Interaksi sosial & perilaku masyarakat', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '323', 'ddc_description' => 'Hak asasi manusia & kebebasan sipil', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '420', 'ddc_description' => 'Bahasa Inggris & linguistik', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '495.6', 'ddc_description' => 'Bahasa Jepang', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '499.221', 'ddc_description' => 'Bahasa Indonesia', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '499.2232', 'ddc_description' => 'Bahasa Sunda', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '510', 'ddc_description' => 'Matematika', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '621', 'ddc_description' => 'Teknik & teknologi listrik', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '700', 'ddc_description' => 'Seni & rekreasi', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '745.2', 'ddc_description' => 'Desain & kerajinan tangan', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '745', 'ddc_description' => 'Desain umum', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '796', 'ddc_description' => 'Olahraga & permainan', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
            ['ddc_code' => '959.8', 'ddc_description' => 'Sejarah Indonesia', 'ddc_created_at' => $now, 'ddc_updated_at' => $now, 'ddc_sys_note' => 'Manual seed'],
                ]);
    }
}
