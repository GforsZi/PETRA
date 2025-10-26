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
            'rl_name' => 'Siswa angkatan 8',
            'rl_description' => 'user role',
        ]);

        $admin = User::firstOrCreate(
            ['usr_no_wa' => '08223456789'],
            [
                'name' => 'ATMINT',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $admin_role->rl_id,
            ],
        );
        $gival = User::firstOrCreate(
            ['usr_no_wa' => '087710113201'],
            [
                'name' => 'Givaldi Gumelar Setiawan',
                'password' => Hash::make('11111'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '085870209618'],
            [
                'name' => 'Nabil Nur Rahmat',
                'password' => Hash::make('291107'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '081649089864'],
            [
                'name' => 'Dion Septian Kevin',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '081222264572'],
            [
                'name' => 'Aiman Fairus',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '089530294376'],
            [
                'name' => 'Amelia Putri Saparani',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '085860306355'],
            [
                'name' => 'Andi Juliansyah',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '082318455641'],
            [
                'name' => 'Abror Fadillah Ramadhan',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '0895610371867'],
            [
                'name' => 'Dian Hakim',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '081395048324'],
            [
                'name' => 'Raditia Scorpio Djayakusumah',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '082119757264'],
            [
                'name' => 'Reyzal',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '0895365173619'],
            [
                'name' => 'Savaira Malika Fitri Handini',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '087740799377'],
            [
                'name' => 'Afif Raihan Habibi',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '083820418906'],
            [
                'name' => 'Aldo Yonanda Firmansyah',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '083847267139'],
            [
                'name' => 'Nadya Septiani Putri',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '08'],
            [
                'name' => 'Nurul Afipah',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '081221600208'],
            [
                'name' => 'Ervaretha Thahirah Purnamasari',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '089502547105'],
            [
                'name' => 'Ghina Fauziyah',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '082115839507'],
            [
                'name' => 'Muhammad Irzi Fahrian Ramadhan',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '08997115620'],
            [
                'name' => 'Muhammad Gia Mardhotillah',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '089647651543'],
            [
                'name' => 'Aldin Nabitha Wiraatmaja',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '082114016575'],
            [
                'name' => 'Zhagat Satria Ramdhani',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '085722334037'],
            [
                'name' => 'Riswanto',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '085148299880'],
            [
                'name' => 'M.Fadla Yaspa Izatulloh',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '083821382743'],
            [
                'name' => 'Muhammad Aditya Maylingga',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '085864978114'],
            [
                'name' => 'Gilbran Fahmi Almufaky',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );

        User::firstOrCreate(
            ['usr_no_wa' => '085926239697'],
            [
                'name' => 'Michael Scofield',
                'password' => Hash::make('12345'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ],
        );
    }
}
