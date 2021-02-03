<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $histories = [
            '~1ヶ月',
            '1~3ヶ月',
            '3~6ヶ月',
            '6~12ヶ月',
            '1年~3年',
            '3年~6年',
            '6年~'
        ];

        for ($i = 0; $i < count($histories); $i++) {
            DB::table('histories')->insert([
                'history' => $histories[$i]
            ]);
        }
    }
}
