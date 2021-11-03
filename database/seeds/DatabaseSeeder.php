<?php

use App\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

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

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Truncate
        User::truncate();

        factory(User::class, 50)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
