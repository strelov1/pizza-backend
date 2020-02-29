<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Product;

class OrderProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(OrderProduct::tableName(), function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('order_id')->unsigned();

            $table->foreign('order_id')
                ->references('id')
                ->on(Order::tableName())
            ;

            $table->bigInteger('product_id')->unsigned();

            $table->foreign('product_id')
                ->references('id')
                ->on(Product::tableName())
            ;

            $table->smallInteger('count')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(OrderProduct::tableName());
    }
}
