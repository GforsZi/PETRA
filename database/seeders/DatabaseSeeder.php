<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        $this->call([
        UserSeeder::class,
            BookMajorSeeder::class,
            BookOriginSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            BookCopySeeder::class,
            AuthorSeeder::class,
            BookAuthorSeeder::class,
            DeweyDecimalClassficationSeeder::class,
            BookDeweyDecimalClassficationSeeder::class,
            TransactionSeeder::class,
            BookTransactionSeeder::class,
            ChatOptionSeeder::class,
            DeviceSeeder::class,
            UserLoginSeeder::class,
        ]);

    }
}
