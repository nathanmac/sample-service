<?php

use App\Guest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // empty table first
        Guest::truncate();

        // create 50 records
        factory(Guest::class, 20)->create();
    }
}
