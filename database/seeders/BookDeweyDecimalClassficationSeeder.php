<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookDeweyDecimalClassficationSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('book_dewey_decimal_classfication')->insert([
            ['bk_ddc_book_id' => 1, 'bk_ddc_classfication_id' => 10],
            ['bk_ddc_book_id' => 2, 'bk_ddc_classfication_id' => 10],
            ['bk_ddc_book_id' => 3, 'bk_ddc_classfication_id' => 10],
            ['bk_ddc_book_id' => 4, 'bk_ddc_classfication_id' => 15],
            ['bk_ddc_book_id' => 5, 'bk_ddc_classfication_id' => 15],
            ['bk_ddc_book_id' => 6, 'bk_ddc_classfication_id' => 15],
            ['bk_ddc_book_id' => 7, 'bk_ddc_classfication_id' => 12],
            ['bk_ddc_book_id' => 8, 'bk_ddc_classfication_id' => 12],
            ['bk_ddc_book_id' => 9, 'bk_ddc_classfication_id' => 12],
            ['bk_ddc_book_id' => 10, 'bk_ddc_classfication_id' => 13],
            ['bk_ddc_book_id' => 11, 'bk_ddc_classfication_id' => 13],
            ['bk_ddc_book_id' => 12, 'bk_ddc_classfication_id' => 13],
            ['bk_ddc_book_id' => 13, 'bk_ddc_classfication_id' => 13],
            ['bk_ddc_book_id' => 14, 'bk_ddc_classfication_id' => 17],
            ['bk_ddc_book_id' => 15, 'bk_ddc_classfication_id' => 17],
            ['bk_ddc_book_id' => 16, 'bk_ddc_classfication_id' => 17],
            ['bk_ddc_book_id' => 17, 'bk_ddc_classfication_id' => 22],
            ['bk_ddc_book_id' => 18, 'bk_ddc_classfication_id' => 23],
            ['bk_ddc_book_id' => 19, 'bk_ddc_classfication_id' => 17],
            ['bk_ddc_book_id' => 20, 'bk_ddc_classfication_id' => 14],
            ['bk_ddc_book_id' => 21, 'bk_ddc_classfication_id' => 8],
            ['bk_ddc_book_id' => 22, 'bk_ddc_classfication_id' => 8],
            ['bk_ddc_book_id' => 23, 'bk_ddc_classfication_id' => 7],
            ['bk_ddc_book_id' => 24, 'bk_ddc_classfication_id' => 6],
            ['bk_ddc_book_id' => 25, 'bk_ddc_classfication_id' => 8],
            ['bk_ddc_book_id' => 26, 'bk_ddc_classfication_id' => 8],
            ['bk_ddc_book_id' => 27, 'bk_ddc_classfication_id' => 8],
            ['bk_ddc_book_id' => 28, 'bk_ddc_classfication_id' => 21],
            ['bk_ddc_book_id' => 29, 'bk_ddc_classfication_id' => 19],
            ['bk_ddc_book_id' => 30, 'bk_ddc_classfication_id' => 19],
            ['bk_ddc_book_id' => 31, 'bk_ddc_classfication_id' => 4],
            ['bk_ddc_book_id' => 32, 'bk_ddc_classfication_id' => 23],
            ['bk_ddc_book_id' => 33, 'bk_ddc_classfication_id' => 17],
            ['bk_ddc_book_id' => 34, 'bk_ddc_classfication_id' => 18],
            ['bk_ddc_book_id' => 35, 'bk_ddc_classfication_id' => 18],
            ['bk_ddc_book_id' => 36, 'bk_ddc_classfication_id' => 2],
            ['bk_ddc_book_id' => 37, 'bk_ddc_classfication_id' => 2],
            ['bk_ddc_book_id' => 38, 'bk_ddc_classfication_id' => 5],
            ['bk_ddc_book_id' => 39, 'bk_ddc_classfication_id' => 16],
            ['bk_ddc_book_id' => 40, 'bk_ddc_classfication_id' => 11],
            ['bk_ddc_book_id' => 41, 'bk_ddc_classfication_id' => 20],
            ['bk_ddc_book_id' => 42, 'bk_ddc_classfication_id' => 12],
            ['bk_ddc_book_id' => 43, 'bk_ddc_classfication_id' => 12],
            ['bk_ddc_book_id' => 44, 'bk_ddc_classfication_id' => 1],
            ['bk_ddc_book_id' => 45, 'bk_ddc_classfication_id' => 8],
            ['bk_ddc_book_id' => 46, 'bk_ddc_classfication_id' => 22],
            ['bk_ddc_book_id' => 47, 'bk_ddc_classfication_id' => 4],
            ['bk_ddc_book_id' => 48, 'bk_ddc_classfication_id' => 3],
            ['bk_ddc_book_id' => 49, 'bk_ddc_classfication_id' => 8],
            ['bk_ddc_book_id' => 50, 'bk_ddc_classfication_id' => 8],
            ['bk_ddc_book_id' => 51, 'bk_ddc_classfication_id' => 8],
        ]);
    }
}
