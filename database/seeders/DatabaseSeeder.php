<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Location;
use App\Models\Service;
use App\Models\StockItem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'merosoftnepal@gmail.com'
        ], [
            'name' => "MeroSoft Nepal",
            'password' => Hash::make('nayapati@12#'),
        ]);
        Location::firstOrCreate([
            'name' => "Location Name First"
        ]);
        StockItem::firstOrCreate([
            'sku' => '32inchsamsungtv',
            'name' => "TV 32' inch Samsung",
        ], [
            'cost_price' => '40567',
            'selling_price' => '60567',
            'minimum_stock' => '5',
        ]);
        Service::firstOrCreate([
            'description' => 'Maintenance Service',
            'name' => "Maintenance",
        ], [
            'rate' => '5000',
            'unit' => 'one time',
        ]);
        Customer::firstOrCreate([
            'name' => 'Kiran Shrestha'
        ], [
            'email' => 'kiran@test.com',
            'location_id' => Location::first()->id,
        ]);
    }
}
