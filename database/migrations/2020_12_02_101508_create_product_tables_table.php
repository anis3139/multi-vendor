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
            $table->string('product_title',128);
            $table->longText('product_discription');
            $table->string('product_slug');
            $table->tinyInteger('product_in_stock')->default(1);
            $table->decimal('product_price', 8, 2);
            $table->integer('product_saving')->default(0);
            $table->decimal('product_selling_price', 8, 2)->nullable();
            $table->decimal('product_tax', 8, 2)->default(0);
            $table->integer('product_delivary_charge')->default(0);
            $table->tinyInteger('product_delivary_charge_type')->default(0);
            $table->integer('product_quantity')->default(1);
            $table->string('product_active')->default('on');
            $table->string('feture_products')->default('on');
            $table->unsignedInteger('product_if_has_color')->default(0);
            $table->unsignedInteger('product_meserment_type')->nullable();
            $table->unsignedInteger('product_category_id');
            $table->unsignedInteger('product_brand_id');
            $table->unsignedInteger('product_owner_id')->default(0);
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
