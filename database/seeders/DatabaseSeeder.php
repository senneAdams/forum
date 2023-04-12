<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\comment;
use App\Models\post;
use Illuminate\Database\Seeder;
use Database\Seeders\userSeeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            userSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
