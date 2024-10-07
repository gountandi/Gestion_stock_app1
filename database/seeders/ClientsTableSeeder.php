<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Client;
use Faker\Factory as Faker;
class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('clients')->insert([
                'nom' => $faker->name,
                'tel' => $faker->phoneNumber,
            ]);
        }
    }
}

