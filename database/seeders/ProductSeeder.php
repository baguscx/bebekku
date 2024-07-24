<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@bebekku.com')->first();

        Product::create([
            'user_id' => $user->id,
            'name' => 'Bebek Dewasa',
            'description' => 'Bebek Dewasa',
            'price' => 10000,
            'stock' => 100,
            'image' => 'bebek-dewasa.jpg',
        ]);

        Product::create([
            'user_id' => $user->id,
            'name' => 'Bebek Remaja',
            'description' => 'Bebek Remaja',
            'price' => 8000,
            'stock' => 100,
            'image' => 'bebek-remaja.jpg',
        ]);

        Product::create([
            'user_id' => $user->id,
            'name' => 'Bebek Anak',
            'description' => 'Bebek Anak',
            'price' => 5000,
            'stock' => 100,
            'image' => 'bebek-anak.jpg',
        ]);

        Product::create([
            'user_id' => $user->id,
            'name' => 'Bebek Bayi',
            'description' => 'Bebek Bayi',
            'price' => 3000,
            'stock' => 100,
            'image' => 'bebek-bayi.jpg',
        ]);

        Product::create([
            'user_id' => $user->id,
            'name' => 'Telur Bebek',
            'description' => 'Telur Bebek',
            'price' => 3000,
            'stock' => 100,
            'image' => 'telur-bebek.jpg',
        ]);

    }
}
