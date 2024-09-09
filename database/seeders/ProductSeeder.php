<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       Product::create([
        "name"=> "Samsung",
        "category_id"=>1,
        "unit_id"=>1,
        "stock_quantity"=>50,
        "user_id"=>1,
        'price'=>10000,
       ]);
       Product::create([
        "name"=> "Potato",
        "category_id"=>2,
        "unit_id"=>2,
        "stock_quantity"=>50,
        "user_id"=>1,
        'price'=>100,
       ]);
       Product::create([
        "name"=> "Banana",
        "category_id"=>3,
        "unit_id"=>3,
        "stock_quantity"=>20,
        "user_id"=>1,
        'price'=>120,
       ]);
       
       


    }
}
