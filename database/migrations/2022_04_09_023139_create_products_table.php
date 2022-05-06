<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_category');
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('brand')->nullable();
            $table->integer('purchase_price');
            $table->integer('sale_price');
            $table->tinyInteger('discount')->nullable();
            $table->integer('stock');
            $table->integer('poin')->default(0);
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
        Schema::dropIfExists('products');
    }
}
