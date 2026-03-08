<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formations = [
            // district_id => [formations]
            1 => ['Banikoara 1', 'Banikoara 2', 'Gogounou', 'Kandi 1', 'Kandi 2', 'Karimama', 'Malanville', 'Ségbana'],
            2 => ['Boukoumbé', 'Cobly', 'Kérou', 'Kouandé', 'Matéri', 'Natitingou 1', 'Natitingou 2',  'Péhunco', 'Tanguiéta', 'Toucountouna'],
            3 => ['Abomey-Calavi 1', 'Abomey-Calavi 2', 'Abomey-Calavi 3', 'Abomey-Calavi 4', 'Abomey-Calavi 5', 'Abomey-Calavi 6', 'Allada 1', 'Allada 2', 'Kpomassè', 'Ouidah 1', 'Ouidah 2', 'Sô-Ava', 'Toffo', 'Tori-Bossito', 'Zè'],
            4 => ['Bembéréké 1', 'Bembéréké 2', 'Kalalé', "N'Dali", 'Nikki', 'Parakou 1', 'Parakou 2', 'Parakou 3', 'Pèrèrè', 'Sinendé', 'Tchaourou 1', 'Tchaourou 2', 'Tchaourou 3'],
            5 => ['Bantè', 'Dassa-Zoumè 1', 'Dassa-Zoumè 2', 'Glazoué 1', 'Glazoué 2', 'Ouèssè', 'Savalou 1', 'Savalou 2', 'Savè'],
            6 => ['Aplahoué 1', 'Aplahoué 2', 'Djakotomey 1', 'Djakotomey 2', 'Dogbo', 'Klouékanmè 1', 'Klouékanmè 2', 'Lalo', 'Toviklin'],
            7 => ['Bassila 1', 'Bassila 2', 'Copargo', 'Djougou 1', 'Djougou 2', 'Djougou 3', 'Ouaké'],
            8 => ['Cotonou 1', 'Cotonou 2', 'Cotonou 3', 'Cotonou 4', 'Cotonou 5', 'Cotonou 6'],
            9 => ['Athiémé', 'Bopa', 'Comé', 'Grand-Popo', 'Houéyogbé 1', 'Houéyogbé 2', 'Lokossa 1', 'Lokossa 2'],
            10 => ['Adjarra', 'Adjohoun', 'Aguégués', 'Akpro-Missérété 1', 'Akpro-Missérété 2', 'Avrankou 1', 'Avrankou 2', 'Bonou', 'Dangbo', 'Porto-Novo 1', 'Porto-Novo 2', 'Porto-Novo 3', 'Sèmè-Kpodji 1', 'Sèmè-Kpodji 2'],
            11 => ['Adja-Ouèrè', 'Ifangni', 'Kétou 1', 'Kétou 2', 'Pobè', 'Sakété'],
            12 => ['Abomey', 'Agbangnizoun', 'Bohicon 1', 'Bohicon 2', 'Bohicon 3', 'Covè', 'Djidja 1', 'Djidja 2', 'Ouinhi', 'Zagnanado', 'Za-Kpota 1', 'Za-Kpota 2', 'Zogbodomey'],
        ];


        foreach ($formations as $district_id => $liste) {
            foreach ($liste as $nom) {
                DB::table('formations')->insert([
                    'district_id' => $district_id,
                    'nom' => $nom,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
