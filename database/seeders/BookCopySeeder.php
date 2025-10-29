<?php

namespace Database\Seeders;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookCopySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();
        $books = Book::get();

        foreach ($books as $book) {
            DB::table('book_copies')->insert([
                [
                    'bk_cp_book_id' => $book->bk_id,
                    'bk_cp_number' => collect(explode(' ', strtoupper(trim($book->bk_title))))->filter()->map(fn($word) => Str::substr($word, 0, 1))->implode('') . '-1',
                    'bk_cp_status' => 1,
                    'bk_cp_created_at' => $now,
                    'bk_cp_updated_at' => $now,
                    'bk_cp_sys_note' => 'Manual seed',
                ],
                [
                    'bk_cp_book_id' => $book->bk_id,
                    'bk_cp_number' => collect(explode(' ', strtoupper(trim($book->bk_title))))->filter()->map(fn($word) => Str::substr($word, 0, 1))->implode('') . '-2',
                    'bk_cp_status' => 1,
                    'bk_cp_created_at' => $now,
                    'bk_cp_updated_at' => $now,
                    'bk_cp_sys_note' => 'Manual seed',
                ],
            ]);
        }
    }
}
