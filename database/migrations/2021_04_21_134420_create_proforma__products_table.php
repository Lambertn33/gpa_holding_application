<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformaProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proforma__products', function (Blueprint $table) {
            $table->uuid('proforma_product_id')->primary();
            $table->uuid('proforma_id');
            $table->foreign('proforma_id')->references('id')->on('proformas');
            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('description');
            $table->bigInteger('quantity');
            $table->bigInteger('unit_cost');
            $table->bigInteger('total_cost');
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
        Schema::dropIfExists('proforma__products');
    }
}
