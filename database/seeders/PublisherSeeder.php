<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder {
    public function run(): void {
        $now = Carbon::now()->toDateTimeString();

        DB::table('publishers')->insert([
            [
                'pub_name' => 'Esensi',
                'pub_address' => 'Jakarta',
                'pub_created_at' => $now,
                'pub_updated_at' => $now,
                'pub_sys_note' => 'Manual seed'
            ],
            [
                'pub_name' => 'Erlangga',
                'pub_address' => 'Jakarta',
                'pub_created_at' => $now,
                'pub_updated_at' => $now,
                'pub_sys_note' => 'Manual seed'
            ]
        ]);
    }
}
