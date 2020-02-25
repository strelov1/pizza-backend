<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;


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

            $table->bigInteger('category_id')->unsigned();

            $table->foreign('category_id')
                ->references('id')
                ->on(Category::tableName())
            ;

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
