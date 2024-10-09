<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Running'],
            ['name' => 'Gym'],
            ['name' => 'Cycling'],
            ['name' => 'Soccer'],
            ['name' => 'Basketball'],
            ['name' => 'Shoes'],
            ['name' => 'Accessories'],
        ];

        DB::table('categories')->insert($categories);
    }
}
