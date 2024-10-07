<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Fournisseur;
use Faker\Factory as Faker;
class FournisseursTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('fournisseurs')->insert([
                'nom' => $faker->company,
                'tel' => $faker->phoneNumber,
            ]);
        }
    }
}
