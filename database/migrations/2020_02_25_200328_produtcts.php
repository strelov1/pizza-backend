<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Product;


class Produtcts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Product::tableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');

            $table->bigInteger('category_id')->unsigned();

            $table->foreign('category_id')
                ->references('id')
                ->on(Category::tableName())
            ;

            $table->bigInteger('image_id')->unsigned();

            $table->foreign('image_id')
                ->references('id')
                ->on(\App\Models\Image::tableName())
            ;

            $table->double('price_eur');
            $table->double('price_usd');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Product::tableName());
    }
}
