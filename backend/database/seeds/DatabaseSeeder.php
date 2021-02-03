<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(HistoryTableSeeder::class);
        $this->call(CategoryTableSeeder::class);

    }
}
