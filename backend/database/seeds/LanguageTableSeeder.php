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
            'HTML',
            'CSS',
            'Sass',
            'Bootstrap',
            'JavaScript',
            'jQuery',
            'WordPress',
            'React.js',
            'Vue.js',
            'PHP',
            'Laravel',
            'Git',
            'Go',
            'Ruby',
            'SQL',
            'Node.js',
            'AngularJS',
            'AWS',
            'Atom',
            'C言語',
            'CakePHP',
            'Django',
            'Docker',
            'Electron',
            'Flutter',
            'Java',
            'Kotlin',
            'Linux',
            'Next.js',
            'Node.js',
            'Objective-C',
            'Python',
            'Ruby on Rails',
            'Swift',
            'TypeScript'
        ];

        $favicons = [
            'html5-plain',
            'css3-plain',
            'sass-original',
            'bootstrap-plain',
            'javascript-plain',
            'jquery-plain',
            'wordpress-plain',
            'react-original',
            'vuejs-plain',
            'php-plain',
            'laravel-plain',
            'git-plain',
            'go-plain',
            'ruby-plain',
            'mysql-plain',
            'nodejs-plain',
            'angularjs-plain',
            'amazonwebservices-plain-wordmark',
            'atom-original',
            'c-plain',
            'cakephp-plain',
            'django-plain',
            'docker-plain-wordmark',
            'electron-original',
            'flutter-plain',
            'java-plain-wordmark',
            'kotlin-plain-wordmark',
            'linux-plain',
            'nextjs-original',
            'nodejs-plain-wordmark',
            'objectivec-plain',
            'python-plain-wordmark',
            'rails-plain-wordmark',
            'swift-plain',
            'typescript-plain'
        ];


        for ($i = 0; $i < count($languages); $i++) {
            DB::table('languages')->insert([
                'name' => $languages[$i],
                'favicon' => $favicons[$i]
            ]);
        }
    }
}
