<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Categorie;

use Faker\Factory as Faker;
class CommandesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('commandes')->insert([
                'vendeur_id'=>$faker->numberBetween(1, 10),
                'client_id' => $faker->numberBetween(1, 10),  // Référence à un fournisseur existant
                'date_cmd' => $faker->date(),
                'montant_total' => $faker->randomFloat(2, 50, 5000),
            ]);
        }
    }
}
