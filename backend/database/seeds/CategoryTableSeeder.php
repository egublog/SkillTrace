<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            'サイト',
            'ブログ',
            '書籍',
            'YouTube',
            'Udemy',
            'スクール',
            'オンラインサロン',
            '独自教材',
            'その他'
        ];

        for ($i = 0; $i < count($categories); $i++) {
            DB::table('categories')->insert([
                'name' => $categories[$i]
            ]);
        }
    }
}
