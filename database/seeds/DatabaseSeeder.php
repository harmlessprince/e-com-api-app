<?php

use App\Product;
use App\Review;
use Faker\Factory;
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
        // $this->call(UserSeeder::class);

        factory(Product::class, 50)->create();
        factory(Review::class,300)->create();
    }
}
