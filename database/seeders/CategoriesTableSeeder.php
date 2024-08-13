<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            '和食', '洋食', '中華', 'アジア', 
        ];

        foreach($categories as $category){
            Category::create([
                'name' => $category,
                'description' => $category,
            ]);
        }
    }
}
