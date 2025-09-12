<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // User::factory(10)->create();


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
            ['email' => 'admin@example.com'],
            [
                'name' => 'gfors',
                'password' => Hash::make('12345'),
                'usr_no_wa' => '08123456789',
                'usr_activation' => true,
                'usr_role_id' => $admin_role->rl_id,
            ]
        );
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'zi',
                'password' => Hash::make('12345'),
                'usr_no_wa' => '08123456789',
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ]
        );
    }
}
