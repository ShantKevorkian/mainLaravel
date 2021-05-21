<?php

namespace Database\Seeders;

use App\Models\Detail;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(50)
            ->has(Detail::factory()->count(1))
            ->has(Post::factory()->count(rand(1,10)))
            ->create();
    }
}
