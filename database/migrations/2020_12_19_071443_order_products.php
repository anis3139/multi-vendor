<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->string('color')->nullable();
            $table->string('maserment')->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('product_owner_id')->default(0);

            // $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('product_tables')->onDelete('cascade');
            // $table->foreign('product_owner_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
