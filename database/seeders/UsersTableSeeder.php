<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create an admin user
        User::create([
            'name' => 'Robin',
            'username' => 'robin123',
            'email' => 'robin123@gmail.com',
            'password' => bcrypt('123456'), 
            'role' => 'customer',
        ]);
    
        // Create 10 customer users
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('123456'),
                'role' => 'customer', // role set to customer
            ]);
        }
    }
}
