<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ["name"=> "Books","slug"=> "books",'created_at'=>now(),
            'updated_at'=>now()],
            ["name"=> "Electronics","slug"=> "electronics",'created_at'=>now(),
            'updated_at'=>now()],
            ["name"=> "Home & Garden","slug"=> "home-garden",'created_at'=>now(),
            'updated_at'=>now()],
            ["name"=> "Pets","slug"=> "pets",'created_at'=>now(),
            'updated_at'=>now()],
            ["name"=> "Food & Grocery","slug"=> "food-grocery",'created_at'=>now(),
            'updated_at'=>now()],
            ["name"=> "Beauty & Health","slug"=> "beauty-health",'created_at'=>now(),
            'updated_at'=>now()],
            ["name"=> "Fashion","slug"=> "fashion",'created_at'=>now(),
            'updated_at'=>now()],
            ["name"=> "Toys","slug"=> "toys",'created_at'=>now(),
            'updated_at'=>now()],
        ];

        DB::table('departments')->insert($departments);
    }
}
