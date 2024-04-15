<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_websites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_id')->references('id')->on('product');
            $table->foreignId('web_id')->references('id')->on('websites');
            $table->integer('last_price');
            $table->dateTime('last_check');
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
        Schema::dropIfExists('product_websites');
    }
}
