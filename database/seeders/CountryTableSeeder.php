<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['iso_code' => 'AF', 'name' => 'Afghanistan'],
            ['iso_code' => 'AL', 'name' => 'Albania'],
            ['iso_code' => 'DZ', 'name' => 'Algeria'],
            ['iso_code' => 'AS', 'name' => 'American Samoa'],
            ['iso_code' => 'AD', 'name' => 'Andorra'],
            ['iso_code' => 'AO', 'name' => 'Angola'],
            ['iso_code' => 'AR', 'name' => 'Argentina'],
            ['iso_code' => 'AM', 'name' => 'Armenia'],
            ['iso_code' => 'AU', 'name' => 'Australia'],
            ['iso_code' => 'AT', 'name' => 'Austria'],
            ['iso_code' => 'AZ', 'name' => 'Azerbaijan'],
            ['iso_code' => 'BD', 'name' => 'Bangladesh'],
            ['iso_code' => 'BE', 'name' => 'Belgium'],
            ['iso_code' => 'BR', 'name' => 'Brazil'],
            ['iso_code' => 'CA', 'name' => 'Canada'],
            ['iso_code' => 'CN', 'name' => 'China'],
            ['iso_code' => 'DK', 'name' => 'Denmark'],
            ['iso_code' => 'EG', 'name' => 'Egypt'],
            ['iso_code' => 'FI', 'name' => 'Finland'],
            ['iso_code' => 'FR', 'name' => 'France'],
            ['iso_code' => 'DE', 'name' => 'Germany'],
            ['iso_code' => 'GR', 'name' => 'Greece'],
            ['iso_code' => 'HK', 'name' => 'Hong Kong'],
            ['iso_code' => 'IN', 'name' => 'India'],
            ['iso_code' => 'ID', 'name' => 'Indonesia'],
            ['iso_code' => 'IR', 'name' => 'Iran'],
            ['iso_code' => 'IQ', 'name' => 'Iraq'],
            ['iso_code' => 'IE', 'name' => 'Ireland'],
            ['iso_code' => 'IT', 'name' => 'Italy'],
            ['iso_code' => 'JP', 'name' => 'Japan'],
            ['iso_code' => 'JO', 'name' => 'Jordan'],
            ['iso_code' => 'KE', 'name' => 'Kenya'],
            ['iso_code' => 'KR', 'name' => 'South Korea'],
            ['iso_code' => 'KW', 'name' => 'Kuwait'],
            ['iso_code' => 'LB', 'name' => 'Lebanon'],
            ['iso_code' => 'MY', 'name' => 'Malaysia'],
            ['iso_code' => 'MX', 'name' => 'Mexico'],
            ['iso_code' => 'NP', 'name' => 'Nepal'],
            ['iso_code' => 'NL', 'name' => 'Netherlands'],
            ['iso_code' => 'NZ', 'name' => 'New Zealand'],
            ['iso_code' => 'NG', 'name' => 'Nigeria'],
            ['iso_code' => 'NO', 'name' => 'Norway'],
            ['iso_code' => 'OM', 'name' => 'Oman'],
            ['iso_code' => 'PK', 'name' => 'Pakistan'],
            ['iso_code' => 'PH', 'name' => 'Philippines'],
            ['iso_code' => 'PL', 'name' => 'Poland'],
            ['iso_code' => 'PT', 'name' => 'Portugal'],
            ['iso_code' => 'QA', 'name' => 'Qatar'],
            ['iso_code' => 'RU', 'name' => 'Russia'],
            ['iso_code' => 'SA', 'name' => 'Saudi Arabia'],
            ['iso_code' => 'SG', 'name' => 'Singapore'],
            ['iso_code' => 'ZA', 'name' => 'South Africa'],
            ['iso_code' => 'ES', 'name' => 'Spain'],
            ['iso_code' => 'LK', 'name' => 'Sri Lanka'],
            ['iso_code' => 'SE', 'name' => 'Sweden'],
            ['iso_code' => 'CH', 'name' => 'Switzerland'],
            ['iso_code' => 'TH', 'name' => 'Thailand'],
            ['iso_code' => 'TR', 'name' => 'Turkey'],
            ['iso_code' => 'UA', 'name' => 'Ukraine'],
            ['iso_code' => 'AE', 'name' => 'United Arab Emirates'],
            ['iso_code' => 'GB', 'name' => 'United Kingdom'],
            ['iso_code' => 'US', 'name' => 'United States'],
            ['iso_code' => 'VN', 'name' => 'Vietnam'],
            ['iso_code' => 'YE', 'name' => 'Yemen'],
        ];
         DB::table('countries')->insert($countries);
    }
}
