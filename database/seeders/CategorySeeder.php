<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name'=>'Computers',
                'slug'=> 'computers',
                'department_id'=>2,
                'parent_id'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Laptop',
                'slug'=> 'laptop',
                'department_id'=>2,
                'parent_id'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'TVs',
                'slug'=> 'tvs',
                'department_id'=>2,
                'parent_id'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Headphones',
                'slug'=> 'headphones',
                'department_id'=>2,
                'parent_id'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Home Decor',
                'slug'=>'home-decor',
                'department_id'=>3,
                'parent_id'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Furniture',
                'slug'=> 'furniture',
                'department_id'=>3,
                'parent_id'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Kitchen & Dining',
                'slug'=> 'kitchen-dining',
                'department_id'=>3,
                'parent_id'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Storage',
                'slug'=> 'storage',
                'department_id'=>3,
                'parent_id'=>null,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Snacks','slug'=> 'snacks','department_id'=>5,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Beverages','slug'=> 'beverages','department_id'=>5,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Breakfast','slug'=> 'breakfast','department_id'=>5,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Coffee','slug'=> 'coffee','department_id'=>5,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Baby Food','slug'=> 'baby-food','department_id'=>5,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Women','slug'=> 'women','department_id'=>7,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Men','slug'=> 'men','department_id'=>7,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Girls','slug'=> 'girls','department_id'=>7,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Boys','slug'=> 'boys','department_id'=>7,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Baby','slug'=> 'baby','department_id'=>7,'parent_id'=>null,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'MacBook','slug'=> 'macBook','department_id'=>2,'parent_id'=>2,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Windows','slug'=> 'windows','department_id'=>2,'parent_id'=>2,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Chromebooks','slug'=> 'chromebooks','department_id'=>2,'parent_id'=>2,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Gaming Laptop','slug'=> 'gaming-laptop','department_id'=>2,'parent_id'=>2,'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Rug','slug'=> 'rug','department_id'=>3,'parent_id'=>5,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Candles','slug'=> 'candles','department_id'=>3,'parent_id'=>5,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Picture Frames','slug'=> 'picture-frames','department_id'=>3,'parent_id'=>5,'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Sofas','slug'=> 'sofas','department_id'=>3,'parent_id'=>6,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Beds','slug'=> 'Beds','department_id'=>3,'parent_id'=>6,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Desks','slug'=> 'Desks','department_id'=>3,'parent_id'=>6,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Clothing','slug'=> 'Clothing','department_id'=>7,'parent_id'=>14,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Shoe','slug'=> 'Shoe','department_id'=>7,'parent_id'=>14,
                'created_at'=>now(),'updated_at'=>now()
            ],
            [
                'name'=>'Jewelry','slug'=> 'Jewelry','department_id'=>7,'parent_id'=>14,
                'created_at'=>now(),'updated_at'=>now()
            ],
            
        ];

        DB::table('categories')->insert($categories);
    }
}
