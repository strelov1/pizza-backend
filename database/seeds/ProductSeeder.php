<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 0; $i < 4; ++$i) {
            $category = factory(\App\Models\Category::class)->create();

            factory(Product::class, 5)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
