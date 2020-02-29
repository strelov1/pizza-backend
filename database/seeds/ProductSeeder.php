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
        for ($i = 0; $i < 4; $i++) {
            $category = factory(\App\Models\Category::class)->create();
            $image = factory(\App\Models\Image::class)->create();

            factory(Product::class, 10)->create()->each(function(Product $product) use ($category, $image) {
                $product->category()->associate($category);
                $product->category()->associate($image);
            });
        }
    }
}
