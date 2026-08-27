<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AboutSeeder::class,
            JourneySeeder::class,
            CategorySeeder::class,
            ClientSeeder::class,
            ToolsSeeder::class,
            ProjectSeeder::class,
            ProjectToolSeeder::class,
            ProjectImageSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
