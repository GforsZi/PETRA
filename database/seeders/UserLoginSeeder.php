<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserLoginSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Konfigurasi (ubah sesuai kebutuhan)
        $days = 30;                // jumlah hari ke belakang termasuk hari ini
        $minPerDay = 5;            // minimum login per hari
        $maxPerDay = 50;           // maksimum login per hari
        $maxUserId = 27;          // asumsikan user id riil tersedia di rentang 1..$maxUserId
        $guestProbability = 20;    // persen kesempatan login sebagai guest (usr_lg_user_id = null)

        $rows = [];

        for ($d = 0; $d < $days; $d++) {
            // Berapa login pada hari ini (acak antara minPerDay dan maxPerDay)
            $count = rand($minPerDay, $maxPerDay);

            for ($i = 0; $i < $count; $i++) {
                // Ambil tanggal hari ini dikurangi d hari, lalu tambahkan waktu acak pada hari itu
                $day = Carbon::now()->subDays($d)->startOfDay();
                $loggedAt = $day->addSeconds(rand(0, 86400 - 1)); // waktu acak di hari tersebut

                // Tentukan user id atau guest
                $isGuest = (rand(1, 27) <= $guestProbability);
                $userId = $isGuest ? null : rand(1, $maxUserId);

                // Optional: variasi minor pada created_at/updated_at (mis. +/- beberapa menit)
                $createdAt = (clone $loggedAt)->addSeconds(rand(0, 300));
                $updatedAt = (clone $createdAt)->addSeconds(rand(0, 60));

                $rows[] = [
                    'usr_lg_user_id'      => $userId,
                    'usr_lg_ip_address'   => $faker->ipv4,
                    'usr_lg_user_agent'   => $faker->userAgent,
                    'usr_lg_logged_in_at' => $loggedAt->toDateTimeString(),
                    'usr_lg_created_at'   => $createdAt->toDateTimeString(),
                    'usr_lg_updated_at'   => $updatedAt->toDateTimeString(),
                    'usr_lg_sys_note'     => 'Auto seed - simulated bulk logins',
                ];
            }
        }

        // Insert massal
        if (!empty($rows)) {
            // Jika dataset sangat besar, pertimbangkan chunked inserts (contoh di bawah)
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
