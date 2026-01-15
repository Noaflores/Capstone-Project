<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\BeverageFactory;
use Database\Factories\FrappeSmoothieFactory;
use Database\Factories\CategoryFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BeverageSeeder::class,
            FrappeSmoothieSeeder::class,
            CategorySeeder::class
        ]);
    }
}
