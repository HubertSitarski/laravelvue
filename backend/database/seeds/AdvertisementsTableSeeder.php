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

        factory(App\Advertisement::class, 50)->create();
    }
}
