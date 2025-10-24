<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder {
    public function run(): void {
        $now = Carbon::now();

        DB::table('transactions')->insert([
            [
                'trx_user_id' => null,
                'trx_borrow_date' => $now->subDays(5)->toDateTimeString(),
                'trx_due_date' => $now->addDays(5)->toDateTimeString(),
                'trx_return_date' => null,
                'trx_status' => '1',
                'trx_title' => '1',
                'trx_description' => 'Transaksi peminjaman manual',
                'trx_created_at' => $now->toDateTimeString(),
                'trx_updated_at' => $now->toDateTimeString(),
                'trx_sys_note' => 'Manual seed'
            ]
        ]);
    }
}
