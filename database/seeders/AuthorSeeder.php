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
            [
                'athr_name' => 'H. A. Sholeh Dimyathi',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Pipit Dwi Komariah',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Yuyus Kardiman',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Anik M. Indriastuti',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Arif Ediyanto',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Maya Harsasi',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'M. Azhar Mustabshirin',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Indriati Agung Rahayu',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Ratna Hapsari',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'M. Adil',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Berti Sagendra',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'R. Bambang Eko Sugihartadi',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Andi Novianto',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Maryanti Wiji Khurniawati',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Henry Pandia',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Okta Purnawirawan',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Okta P.',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Sumantoro Kasdhani',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'A. Bowo Wasono',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Rubadi',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Kasmina',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Toali',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Agung Widyastara',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Yayat Sudaryat',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Rani Rabiussani',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Tim Sudah Dong',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Johana Renny Octavia',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
            [
                'athr_name' => 'Fuad Aljihad',
                'athr_created_at' => $now,
                'athr_updated_at' => $now,
                'athr_sys_note' => 'Manual seed',
            ],
        ]);
    }
}
