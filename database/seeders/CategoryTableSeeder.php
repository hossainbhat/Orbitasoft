<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics' => [
                'Mobile Phones',
                'Laptops',
                'Cameras',
                'Televisions',
                'Accessories'
            ],
            'Fashion' => [
                'Men',
                'Women',
                'Kids',
                'Shoes',
                'Bags'
            ],
            'Home & Living' => [
                'Furniture',
                'Kitchen',
                'Decor',
                'Bedding'
            ],
            'Beauty & Health' => [
                'Makeup',
                'Skincare',
                'Haircare',
                'Personal Care'
            ],
            'Sports & Outdoors' => [
                'Fitness Equipment',
                'Outdoor Gear',
                'Sportswear'
            ]
        ];

        foreach ($categories as $parent => $children) {
            $parentId = DB::table('categories')->insertGetId([
                'name' => $parent,
                'slug' => Str::slug($parent),
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($children as $child) {
                DB::table('categories')->insert([
                    'name' => $child,
                    'slug' => Str::slug($child),
                    'parent_id' => $parentId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
