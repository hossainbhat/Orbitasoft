<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            'name' =>'Super-Admin',
            'email' =>'admin@admin.com',
            'password' => bcrypt(123456),
            'user_type'=>1
        ];
        DB::table('users')->insert($data);
    }
}
