<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\LigneCommande;
use Faker\Factory as Faker;
class LigneCommandesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('lignes_commandes')->insert([
                'cmd_id' => $faker->numberBetween(1, 10),  // Associe avec une commande existante
                'prod_id' => $faker->numberBetween(1, 10),   // Associe avec un produit existant
                'qte_ligne' => $faker->numberBetween(1, 10),
                'montant' => $faker->randomFloat(2, 10, 1000),
            ]);
        }
    }
}
