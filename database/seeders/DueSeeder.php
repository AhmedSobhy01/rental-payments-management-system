<?php

namespace Database\Seeders;

use App\Models\Due;
use Illuminate\Database\Seeder;

class DueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Due::factory(50)->create();
    }
}