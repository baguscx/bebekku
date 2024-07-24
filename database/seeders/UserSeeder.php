<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@bebekku.com',
            'password' => 'password',
        ])->assignRole('admin');

        User::create([
            'name' => 'owner',
            'email' => 'owner@bebekku.com',
            'password' => 'password',
        ])->assignRole('owner');

        User::create([
            'name' => 'buyer',
            'email' => 'buyer@bebekku.com',
            'password' => 'password',
        ])->assignRole('buyer');
    }
}
