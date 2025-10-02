<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bangladesh = DB::table('countries')->where('iso_code', 'BD')->first();

        if ($bangladesh) {
            $cities = [
                ['name' => 'Bagerhat', 'country_id' => $bangladesh->id],
                ['name' => 'Bandarban', 'country_id' => $bangladesh->id],
                ['name' => 'Barguna', 'country_id' => $bangladesh->id],
                ['name' => 'Barishal', 'country_id' => $bangladesh->id],
                ['name' => 'Bhola', 'country_id' => $bangladesh->id],
                ['name' => 'Bogura', 'country_id' => $bangladesh->id],
                ['name' => 'Brahmanbaria', 'country_id' => $bangladesh->id],
                ['name' => 'Chandpur', 'country_id' => $bangladesh->id],
                ['name' => 'Chattogram', 'country_id' => $bangladesh->id],
                ['name' => 'Chuadanga', 'country_id' => $bangladesh->id],
                ['name' => 'Cox’s Bazar', 'country_id' => $bangladesh->id],
                ['name' => 'Cumilla', 'country_id' => $bangladesh->id],
                ['name' => 'Dhaka', 'country_id' => $bangladesh->id],
                ['name' => 'Dinajpur', 'country_id' => $bangladesh->id],
                ['name' => 'Faridpur', 'country_id' => $bangladesh->id],
                ['name' => 'Feni', 'country_id' => $bangladesh->id],
                ['name' => 'Gaibandha', 'country_id' => $bangladesh->id],
                ['name' => 'Gazipur', 'country_id' => $bangladesh->id],
                ['name' => 'Gopalganj', 'country_id' => $bangladesh->id],
                ['name' => 'Habiganj', 'country_id' => $bangladesh->id],
                ['name' => 'Jamalpur', 'country_id' => $bangladesh->id],
                ['name' => 'Jashore', 'country_id' => $bangladesh->id],
                ['name' => 'Jhalokati', 'country_id' => $bangladesh->id],
                ['name' => 'Jhenaidah', 'country_id' => $bangladesh->id],
                ['name' => 'Joypurhat', 'country_id' => $bangladesh->id],
                ['name' => 'Khagrachhari', 'country_id' => $bangladesh->id],
                ['name' => 'Khulna', 'country_id' => $bangladesh->id],
                ['name' => 'Kishoreganj', 'country_id' => $bangladesh->id],
                ['name' => 'Kurigram', 'country_id' => $bangladesh->id],
                ['name' => 'Kushtia', 'country_id' => $bangladesh->id],
                ['name' => 'Lakshmipur', 'country_id' => $bangladesh->id],
                ['name' => 'Lalmonirhat', 'country_id' => $bangladesh->id],
                ['name' => 'Madaripur', 'country_id' => $bangladesh->id],
                ['name' => 'Magura', 'country_id' => $bangladesh->id],
                ['name' => 'Manikganj', 'country_id' => $bangladesh->id],
                ['name' => 'Meherpur', 'country_id' => $bangladesh->id],
                ['name' => 'Moulvibazar', 'country_id' => $bangladesh->id],
                ['name' => 'Munshiganj', 'country_id' => $bangladesh->id],
                ['name' => 'Mymensingh', 'country_id' => $bangladesh->id],
                ['name' => 'Naogaon', 'country_id' => $bangladesh->id],
                ['name' => 'Narail', 'country_id' => $bangladesh->id],
                ['name' => 'Narayanganj', 'country_id' => $bangladesh->id],
                ['name' => 'Narsingdi', 'country_id' => $bangladesh->id],
                ['name' => 'Natore', 'country_id' => $bangladesh->id],
                ['name' => 'Netrokona', 'country_id' => $bangladesh->id],
                ['name' => 'Nilphamari', 'country_id' => $bangladesh->id],
                ['name' => 'Noakhali', 'country_id' => $bangladesh->id],
                ['name' => 'Pabna', 'country_id' => $bangladesh->id],
                ['name' => 'Panchagarh', 'country_id' => $bangladesh->id],
                ['name' => 'Patuakhali', 'country_id' => $bangladesh->id],
                ['name' => 'Pirojpur', 'country_id' => $bangladesh->id],
                ['name' => 'Rajbari', 'country_id' => $bangladesh->id],
                ['name' => 'Rajshahi', 'country_id' => $bangladesh->id],
                ['name' => 'Rangamati', 'country_id' => $bangladesh->id],
                ['name' => 'Rangpur', 'country_id' => $bangladesh->id],
                ['name' => 'Satkhira', 'country_id' => $bangladesh->id],
                ['name' => 'Shariatpur', 'country_id' => $bangladesh->id],
                ['name' => 'Sherpur', 'country_id' => $bangladesh->id],
                ['name' => 'Sirajganj', 'country_id' => $bangladesh->id],
                ['name' => 'Sunamganj', 'country_id' => $bangladesh->id],
                ['name' => 'Sylhet', 'country_id' => $bangladesh->id],
                ['name' => 'Tangail', 'country_id' => $bangladesh->id],
                ['name' => 'Thakurgaon', 'country_id' => $bangladesh->id],
            ];

            DB::table('cities')->insert($cities);
        }
    }
}
