<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::firstOrCreate([
            'rl_name' => 'Pustakawan',
            'rl_description' => 'sarana perasarana',
            'rl_admin' => true,
        ]);
        $user_role = Role::firstOrCreate([
            'rl_name' => 'Siswa',
            'rl_description' => 'user role',
        ]);

        $admin = User::firstOrCreate(
            ['usr_no_wa' => '08223456789'],
            [
                'name' => 'gfors',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $admin_role->rl_id,
            ],
        );
        $user = User::firstOrCreate(
            ['usr_no_wa' => '08123456789'],
            [
                'name' => 'zi',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );
    }
}
