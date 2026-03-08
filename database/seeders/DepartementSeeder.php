<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departements = [
            'Alibori',
            'Atacora',
            'Atlantique',
            'Borgou',
            'Collines',
            'Couffo',
            'Donga',
            'Littoral',
            'Mono',
            'Ouémé',
            'Plateau',
            'Zou',
        ];

        foreach ($departements as $nom) {
            DB::table('departements')->insert([
                'nom' => $nom,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
