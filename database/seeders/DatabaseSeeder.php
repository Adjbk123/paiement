<?php

namespace Database\Seeders;


use Database\Seeders\CirconscriptionSeeder;
use Database\Seeders\DepartementSeeder;
use Database\Seeders\DistrictSeeder;
use Database\Seeders\FormationSeeder;
use Database\Seeders\ProvinceSeeder;
use Database\Seeders\RegionSeeder;
use Illuminate\Database\Seeder;

// Import des seeders


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            // Toujours parent avant enfant
            DepartementSeeder::class,
            CirconscriptionSeeder::class,
            DistrictSeeder::class,
            FormationSeeder::class,
            ProvinceSeeder::class,
            RegionSeeder::class,


        ]);
    }
}
