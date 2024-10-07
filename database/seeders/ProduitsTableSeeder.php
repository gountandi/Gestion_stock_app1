<?php

namespace Database\Seeders;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Produit;
use Faker\Factory as Faker;
class ProduitsTableSeeder extends Seeder
{
    public function run()
    {$faker = Faker::create();

        // Récupérer toutes les catégories existantes
        $categories = Categorie::all();

        // Générer 100 produits
        foreach (range(1, 100) as $index) {
            Produit::create([
                'image' => $faker->word,
                'libelle' => $faker->sentence(3),
                'qte_stock' => $faker->numberBetween(10, 100),
                'marque' => $faker->company,
                'prix_unitaire' => $faker->randomFloat(2, 5, 100),
                'image' => $faker->imageUrl(640, 480, 'technics', true), // Générer une URL d'image aléatoire
                'categorie_id' => $categories->random()->id, // Assigner une catégorie aléatoire
            ]);
        }
    }
}
