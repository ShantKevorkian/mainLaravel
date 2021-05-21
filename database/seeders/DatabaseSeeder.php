<?php

namespace Database\Seeders;

use App\Models\Post;
use Database\Factories\ProfessionPostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProfessionSeeder::class
        ]);
    }
}
