<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorie::create(['name' => 'for girls']);
        Categorie::create(['name' => 'for boys']);
        Categorie::create(['name' => 'for babies']);
        Categorie::create(['name' => 'for home']);
        Categorie::create(['name' => 'for play']);
    }
}
