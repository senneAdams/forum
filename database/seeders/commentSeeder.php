<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class commentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('comment')->insert([
                'byUserID'   => 1,
                'fromPostID' => rand(1, 5),
                'Title'      => Str::random(10),
                'Content'    => Str::random(20),
                'Rating'     => 5,
            ]);
        }
    }
}
