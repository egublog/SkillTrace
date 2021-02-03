<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $languages = [
            'HTML', 'CSS', 'Sass', 'Bootstrap', 'JavaScript', 'jQuery', 'WordPress', 'React.js', 'Vue.js', 'PHP', 'Laravel', 'Git', 'Go', 'Ruby', 'SQL', 'Node.js'
        ];

        $favicons = [
            'html5-plain', 'css3-plain', 'sass-original', 'bootstrap-plain', 'javascript-plain', 'jquery-plain', 'wordpress-plain', 'react-original', 'vuejs-plain', 'php-plain', 'laravel-plain', 'git-plain', 'go-plain', 'ruby-plain', 'sql-plain', 'nodejs-plain'
        ];




        for($i = 0; $i < count($languages); $i++) {
            DB::table('languages')->insert([
                'name' => $languages[$i],
                'favicon' => $favicons[$i]
            ]);
        }
    }
}
