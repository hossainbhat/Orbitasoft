<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(AttributeTableSeeder::class);
        $this->call(UserTableSeeder::class);
        // $this->call(RolePermissionTableSeeder::class);
    }
}
