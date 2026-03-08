<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CirconscriptionServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $circonscription_services = [
            // departement_service_id => [circonscription_services]
            1 => ['Banikoara', 'Gogounou', 'Kandi', 'Karimama', 'Malanville', 'Ségbana'],
            2 => ['Boukoumbé', 'Cobly', 'Kérou', 'Kouandé', 'Matéri', 'Natitingou', 'Péhunco', 'Tanguiéta', 'Toucountouna'],
            3 => ['Abomey-Calavi', 'Allada', 'Kpomassè', 'Ouidah', 'Sô-Ava', 'Toffo', 'Tori-Bossito', 'Zè'],
            4 => ['Bembéréké', 'Kalalé', "N'Dali", 'Nikki', 'Parakou', 'Pèrèrè', 'Sinendé', 'Tchaourou'],
            5 => ['Bantè', 'Dassa-Zoumè', 'Glazoué', 'Ouèssè', 'Savalou', 'Savè'],
            6 => ['Aplahoué', 'Djakotomey', 'Dogbo', 'Klouékanmè', 'Lalo', 'Toviklin'],
            7 => ['Bassila', 'Copargo', 'Djougou', 'Ouaké'],
            8 => ['Cotonou'],
            9 => ['Athiémé', 'Bopa', 'Comé', 'Grand-Popo', 'Houéyogbé', 'Lokossa'],
            10 => ['Adjarra', 'Adjohoun', 'Aguégués', 'Akpro-Missérété', 'Avrankou', 'Bonou', 'Dangbo', 'Porto-Novo', 'Sèmè-Kpodji'],
            11 => ['Adja-Ouèrè', 'Ifangni', 'Kétou', 'Pobè', 'Sakété'],
            12 => ['Abomey', 'Agbangnizoun', 'Bohicon', 'Covè', 'Djidja', 'Ouinhi', 'Zagnanado', 'Za-Kpota', 'Zogbodomey'],
        ];

        foreach ($circonscription_services as $departement_service_id => $liste) {
            foreach ($liste as $nom) {
                DB::table('circonscription_services')->insert([
                    'departement_service_id' => $departement_service_id,
                    'nom' => $nom,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
