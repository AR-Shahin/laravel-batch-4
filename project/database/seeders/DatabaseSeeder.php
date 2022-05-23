<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Product::factory(20)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);


        User::create([
            'name' => 'editor',
            'email' => 'editor@mail.com',
            'password' => bcrypt('password'),
            'role' => 'editor',
        ]);
    }
}
