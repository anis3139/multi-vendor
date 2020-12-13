<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tables', function (Blueprint $table) {
            $table->id();
            $table->string('product_title');
            $table->text('product_discription');
            $table->string('product_slug');
            $table->integer('product_quantity')->default(1);
            $table->integer('product_category_id');
            $table->integer('product_brand_id');
            $table->integer('product_measurements_id');
            $table->binary('product_if_has_color');
            $table->integer('product_owner_id');
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
        Schema::dropIfExists('product_tables');
    }
}
