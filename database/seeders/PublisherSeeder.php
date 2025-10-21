<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('publishers')->insert([
            [
                'pub_name' => 'PT. Penerbit Nusantara',
                'pub_address' => 'Jl. Merdeka No.1, Jakarta',
                'pub_created_at' => $now,
                'pub_updated_at' => $now,
                'pub_sys_note' => 'Manual seed'
            ],
            [
                'pub_name' => 'Gramedia Pustaka',
                'pub_address' => 'Jl. Sudirman No.10, Jakarta',
                'pub_created_at' => $now,
                'pub_updated_at' => $now,
                'pub_sys_note' => 'Manual seed'
            ],
        ]);
    }
}
