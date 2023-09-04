<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id');

        Categories::create([
            'name' => 'Infrastruktur',
            'slug' => 'infrastruktur',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Lingkungan',
            'slug' => 'lingkungan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Categories::create([
            'name' => 'Layanan Publik',
            'slug' => 'layanan-publik',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Keamanan',
            'slug' => 'keamanan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Kesehatan',
            'slug' => 'kesehatan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Categories::create([
            'name' => 'Lain-lain',
            'slug' => 'lain-lain',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}