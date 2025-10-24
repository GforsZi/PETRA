<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookDeweyDecimalClassficationSeeder extends Seeder {
    public function run(): void {
        $books = DB::table('books')->pluck('bk_id')->toArray();
        $ddc = DB::table('dewey_decimal_classfications')->pluck('ddc_id')->toArray();

        $inserts = [];
        foreach ($books as $i => $bkId) {
            $ddcId = $ddc[$i % max(1, count($ddc))] ?? null;
            if ($ddcId) {
                $inserts[] = [
                    'bk_ddc_book_id' => $bkId,
                    'bk_ddc_classfication_id' => $ddcId,
                    'bk_ddc_created_by' => null,
                    'bk_ddc_sys_note' => 'Manual seed'
                ];
            }
        }

        if (!empty($inserts)) {
            DB::table('book_dewey_decimal_classfication')->insert($inserts);
        }
    }
}
