<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class postSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++){
            DB::table('post')->insert([
                'createdByUserID' => 1,
                'Title' => Str::random(10),
                'Content' => Str::random(20),
                'Rating'=> 5
            ]);
        }
    }
}
