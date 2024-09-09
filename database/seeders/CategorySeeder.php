<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "name"=>"Mobile",
            "description"=>"This is a mobile",
        ]);
        Category::create([
            "name"=>"Vegetables",
            "description"=>"this is vegetable",
        ]);
        Category::create([
            "name"=>"Fruits",
            "description"=>"this is fruit",
        ]);
        
    }
}
