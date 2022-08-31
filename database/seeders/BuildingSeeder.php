<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Building::factory(50)->create()->each(function ($building) {
			$floors = rand(1, 20);
			$apartments_on_floor = rand(1, 4);

			$apartments = [];
			foreach (range(1, $floors) as $floor) {
				foreach (range(1, $apartments_on_floor) as $apartment) {
					$apartments[] = new Apartment([
						'floor' => $floor,
						'number' => $apartment,
					]);
				}
			}

			$building->apartments()->saveMany($apartments);
		});
    }
}