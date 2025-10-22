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
            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Pendidikan Agama Islam dan Budi Pekerti', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Pendidikan Agama Islam dan Budi Pekerti', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Pendidikan Agama Islam dan Budi Pekerti', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Bahasa Indonesia', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Bahasa Indonesia', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Bahasa Indonesia', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Pendidikan Pancasila', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Pendidikan Pancasila', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Pendidikan Pancasila', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Bahasa Inggris', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Bahasa Inggris', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Bahasa Inggris', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Matematika', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Matematika', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Matematika', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Sejarah', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Sejarah', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Sejarah', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Ilmu Pengetahuan Alam dan Sosial', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Ilmu Pengetahuan Alam dan Sosial', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Ilmu Pengetahuan Alam dan Sosial', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Bahasa Jepang', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Bahasa Jepang', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Bahasa Jepang', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Kreativitas Inovasi dan Kewirausahaan', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Kreativitas Inovasi dan Kewirausahaan', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Kreativitas Inovasi dan Kewirausahaan', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Informatika', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Informatika', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Informatika', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Pengembangan Perangkat Lunak dan Gim', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Pengembangan Perangkat Lunak dan Gim', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Pengembangan Perangkat Lunak dan Gim', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Desain Komunikasi Visual', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Desain Komunikasi Visual', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Desain Komunikasi Visual', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],

            ['bk_mjr_class' => 'X', 'bk_mjr_major' => 'Bimbingan konseling', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XI', 'bk_mjr_major' => 'Bimbingan konseling', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
            ['bk_mjr_class' => 'XII', 'bk_mjr_major' => 'Bimbingan konseling', 'bk_mjr_created_at' => $now, 'bk_mjr_updated_at' => $now, 'bk_mjr_sys_note' => 'Manual seed'],
        ]);
    }
}
