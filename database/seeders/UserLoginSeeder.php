<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserLoginSeeder extends Seeder {
    public function run(): void {
        $faker = Faker::create();

        $days = 30;
        $minPerDay = 5;
        $maxPerDay = 50;
        $maxUserId = 27;

        $rows = [];

        for ($d = 0; $d < $days; $d++) {
            $count = rand($minPerDay, $maxPerDay);

            for ($i = 0; $i < $count; $i++) {
                $day = Carbon::now()->subDays($d)->startOfDay();
                $loggedAt = $day->addSeconds(rand(0, 86400 - 1));

                $userId = rand(1, $maxUserId);
                $createdAt = (clone $loggedAt)->addSeconds(rand(0, 300));
                $updatedAt = (clone $createdAt)->addSeconds(rand(0, 60));

                $rows[] = [
                    'usr_lg_user_id' => $userId,
                    'usr_lg_ip_address' => $faker->ipv4,
                    'usr_lg_user_agent' => $faker->userAgent,
                    'usr_lg_logged_in_at' => $loggedAt->toDateTimeString(),
                    'usr_lg_created_at' => $createdAt->toDateTimeString(),
                    'usr_lg_updated_at' => $updatedAt->toDateTimeString(),
                    'usr_lg_sys_note' => 'Auto seed - simulated bulk logins'
                ];
            }
        }
        if (!empty($rows)) {
            $chunkSize = 1000;
            $chunks = array_chunk($rows, $chunkSize);
            foreach ($chunks as $chunk) {
                DB::table('user_logins')->insert($chunk);
            }

            $this->command->info('Inserted ' . count($rows) . ' user_login records over last ' . $days . ' days.');
        } else {
            $this->command->info('No rows to insert.');
        }
    }
}
