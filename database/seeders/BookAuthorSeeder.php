<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookAuthorSeeder extends Seeder
{
    public function run(): void
    {
        $books = DB::table('books')->pluck('bk_id')->toArray();
        $authors = DB::table('authors')->pluck('athr_id')->toArray();

        $inserts = [];
        foreach ($books as $i => $bkId) {
            $authorId = $authors[$i % max(1, count($authors))] ?? null;
            if ($authorId) {
                $inserts[] = [
                    'bk_athr_book_id' => $bkId,
                    'bk_athr_author_id' => $authorId,
                    'bk_athr_created_by' => null,
                    'bk_athr_sys_note' => 'Manual seed'
                ];
            }
        }

        if (!empty($inserts)) {
            DB::table('book_author')->insert($inserts);
        }
    }
}
