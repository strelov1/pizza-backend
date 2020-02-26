<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $category = factory(\App\Models\Category::class)->create();

            factory(Product::class, 10)->create()->each(function(Product $product) use ($category) {
                $product->category()->associate($category);
            });
        }
    }
}
