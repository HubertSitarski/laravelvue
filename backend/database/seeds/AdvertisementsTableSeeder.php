<?php

use Illuminate\Database\Seeder;
use App\Advertisement;

/**
 * Class AdvertisementsTableSeeder
 */
class AdvertisementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertisement::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Advertisement::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'quantity' => $faker->numberBetween(1, 10),
                'price' => $faker->randomFloat(2, 10, 1000),
                'user_id' => 1
            ]);
        }
    }
}
