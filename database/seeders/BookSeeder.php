<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        // Ambil publisher/major/origin yang sudah di-seed sebelumnya
        $pub = DB::table('publishers')->first();
        $pub2 = DB::table('publishers')->skip(1)->first();
        $mjr = DB::table('book_majors')->first();
        $mjr2 = DB::table('book_majors')->skip(1)->first();
        $orgn = DB::table('book_origins')->first();
        $orgn2 = DB::table('book_origins')->skip(1)->first();

        DB::table('books')->insert([
            [
                'bk_isbn' => '978-602-123-000-1',
                'bk_title' => 'Belajar Laravel untuk Pemula',
                'bk_description' => 'Panduan praktis membangun aplikasi web dengan Laravel.',
                'bk_page' => 250,
                'bk_img_url' => null,
                'bk_img_public_id' => null,
                'bk_type' => '1',
                'bk_permission' => '1',
                'bk_file_url' => null,
                'bk_file_public_id' => null,
                'bk_unit_price' => 85000,
                'bk_edition_volume' => '1',
                'bk_published_year' => 2022,
                'bk_publisher_id' => $pub->pub_id ?? null,
                'bk_major_id' => $mjr->bk_mjr_id ?? null,
                'bk_origin_id' => $orgn->bk_orgn_id ?? null,
                'bk_created_at' => $now,
                'bk_updated_at' => $now,
                'bk_sys_note' => 'Manual seed'
            ],
            [
                'bk_isbn' => '978-602-123-000-2',
                'bk_title' => 'Algoritma dan Struktur Data',
                'bk_description' => 'Dasar-dasar algoritma dan struktur data untuk pemrogram.',
                'bk_page' => 320,
                'bk_img_url' => null,
                'bk_img_public_id' => null,
                'bk_type' => '2',
                'bk_permission' => '2',
                'bk_file_url' => null,
                'bk_file_public_id' => null,
                'bk_unit_price' => 120000,
                'bk_edition_volume' => '2',
                'bk_published_year' => 2020,
                'bk_publisher_id' => $pub2->pub_id ?? ($pub->pub_id ?? null),
                'bk_major_id' => $mjr2->bk_mjr_id ?? ($mjr->bk_mjr_id ?? null),
                'bk_origin_id' => $orgn2->bk_orgn_id ?? ($orgn->bk_orgn_id ?? null),
                'bk_created_at' => $now,
                'bk_updated_at' => $now,
                'bk_sys_note' => 'Manual seed'
            ],
        ]);
    }
}
