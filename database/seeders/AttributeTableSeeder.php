<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'Color' => ['Red', 'Blue', 'Green', 'Black', 'White', 'Yellow'],
            'Size' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
            'Material' => ['Cotton', 'Polyester', 'Leather', 'Wool', 'Silk'],
            'Brand' => ['Nike', 'Adidas', 'Puma', 'Reebok', 'Levis'],
        ];

        foreach ($attributes as $attrName => $values) {
            $attributeId = DB::table('attributes')->insertGetId([
                'name' => $attrName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $insertValues = [];
            foreach ($values as $value) {
                $insertValues[] = [
                    'attribute_id' => $attributeId,
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('attribute_values')->insert($insertValues);
        }
    }
}
