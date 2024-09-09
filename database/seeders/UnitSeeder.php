<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;
class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            "name"=> "Piece",
            "abbreviation"=>"PC"
        ]);
        Unit::create([
            "name"=> "Kilogram",
            "abbreviation"=>"KG"
        ]);
        Unit::create([
            "name"=> "Dozen",
            "abbreviation"=>"DZ"
        ]);
    }
}
