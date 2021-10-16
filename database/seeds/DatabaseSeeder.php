<?php

use App\AppSetting;
use App\Customer;
use Database\Seeders\DistrictSeeder;
use Database\Seeders\DivisionSeeder;
use Database\Seeders\UpazilaSeeder;
use Database\Seeders\WholeSaleSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(Categoryseeder::class);
        $this->call(SliderSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(ProductSeeder::class);

        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UpazilaSeeder::class);

        $this->call(WholeSaleSeeder::class);


        Customer::create([
            'customer_name' => "Motiur Rahaman",
            'customer_phone' => "01717849968",
            'customer_email' => "customer@gmail.com",
            'customer_password' => Hash::make("123456")
        ]);

        \App\CustomerAddress::create([
            'customer_id' => 1,
            'division_id' => 1,
            'district_id' => 4,
            'upazila_id' => 8,
            'customer_address' => "Mirpur-1, Dhaka",
        ]);


        AppSetting::create([
            'app_version' => 1,
        ]);

        \App\DeliveryCharge::create([
            'product_quantity' => 20,
            'delivery_charge' => 150,
            'extra_charge' => 2,
        ]);

    }
}
