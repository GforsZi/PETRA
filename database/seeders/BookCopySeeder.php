<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookCopySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        $books = DB::table('books')->pluck('bk_id')->toArray();
        $inserts = [];

        foreach ($books as $bkId) {
            $inserts[] = [
                'bk_cp_book_id' => $bkId,
                'bk_cp_number' => sprintf('BC-%s-01', $bkId),
                'bk_cp_status' => '1',
                'bk_cp_created_at' => $now,
                'bk_cp_updated_at' => $now,
                'bk_cp_sys_note' => 'Manual seed'
            ];
            $inserts[] = [
                'bk_cp_book_id' => $bkId,
                'bk_cp_number' => sprintf('BC-%s-02', $bkId),
                'bk_cp_status' => '1',
                'bk_cp_created_at' => $now,
                'bk_cp_updated_at' => $now,
                'bk_cp_sys_note' => 'Manual seed'
            ];
        }

        if (!empty($inserts)) {
            DB::table('book_copies')->insert($inserts);
        }
    }
}
