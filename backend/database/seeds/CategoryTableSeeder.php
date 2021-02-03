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
            'オンラインサロン'
        ];

        for ($i = 0; $i < count($categories); $i++) {
            DB::table('categories')->insert([
                'name' => $categories[$i]
            ]);
        }
    }
}
