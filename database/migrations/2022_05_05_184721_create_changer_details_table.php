<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_changer');
            $table->integer('id_product');
            $table->integer('price_purchase');
            $table->integer('amount');
            $table->integer('subtotal');
            $table->integer('total_poin');
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
        Schema::dropIfExists('changer_details');
    }
}
