<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        User::create([
            'name' => "Motiur",
            'email' => "memotiur@gmail.com",
            'phone' => "01717849968",
            'user_type' => 1,
            'profile_pic' => "/users/user.jpg",
            'password' => Hash::make('123456')
        ]);

        User::create([
            'name' => "Motiur",
            'email' => "saiful0131@gmail.com",
            'phone' => "01825013101",
            'user_type' => 2,
            'profile_pic' => "/users/user.jpg",
            'password' => Hash::make('123456')
        ]);

    }
}
