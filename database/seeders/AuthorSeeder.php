<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('authors')->insert([
            ['athr_name' => 'Nabil', 'athr_created_at' => $now, 'athr_updated_at' => $now, 'athr_sys_note' => 'Manual seed'],
            ['athr_name' => 'Dion', 'athr_created_at' => $now, 'athr_updated_at' => $now, 'athr_sys_note' => 'Manual seed'],
        ]);
    }
}
