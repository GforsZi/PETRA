<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        $trx = DB::table('transactions')->pluck('trx_id')->toArray();
        $bookCopies = DB::table('book_copies')->pluck('bk_cp_id')->toArray();
        $books = DB::table('books')->pluck('bk_id')->toArray();

        $inserts = [];
        if (!empty($trx) && !empty($bookCopies)) {
            $inserts[] = [
                'bk_trx_book_id' => $books[0] ?? null,
                'bk_trx_book_copy_id' => $bookCopies[0] ?? null,
                'bk_trx_transaction_id' => $trx[0] ?? null,
                'bk_trx_created_at' => $now,
                'bk_trx_updated_at' => $now,
                'bk_trx_sys_note' => 'Manual seed'
            ];
        }

        if (!empty($inserts)) {
            DB::table('book_transaction')->insert($inserts);
        }
    }
}
