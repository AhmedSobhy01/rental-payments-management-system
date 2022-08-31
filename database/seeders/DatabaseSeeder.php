<?php

namespace Database\Seeders;

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
        $this->call([
            NationalitySeeder::class,
            UserSeeder::class,
            // TenantSeeder::class,
            // BuildingSeeder::class,
            // ContractSeeder::class,
            DueCategorySeeder::class,
            // DueSeeder::class,
        ]);
    }
}