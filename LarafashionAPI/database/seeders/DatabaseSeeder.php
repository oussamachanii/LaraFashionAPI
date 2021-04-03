<?php

namespace Database\Seeders;

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
         \App\Models\User::factory(100)->create();
         \App\Models\Category::factory(10)->create();
        \App\Models\Product::factory(10)->create();
         \App\Models\Color::factory(50)->create();
         \App\Models\Rating::factory(1000)->create();
         \App\Models\Size::factory(5)->create();
         \App\Models\Image::factory(50)->create();
         \App\Models\Purchase::factory(1000)->create();
    }
}
