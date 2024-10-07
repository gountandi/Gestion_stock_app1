<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run()
{
    $this->call([
        ClientsTableSeeder::class,
        UsersTableSeeder::class,
        FournisseursTableSeeder::class,
        CategoriesTableSeeder::class,
        ProduitsTableSeeder::class,
        CommandesTableSeeder::class,
        LigneCommandesTableSeeder::class,
        ApprovisionnementsTableSeeder::class,
        LigneApprovisionementTableSeeder::class,
        //PermissionTableSeeder::class,
        CreateGerantUserSeeder::class,
    ]);
}
}
