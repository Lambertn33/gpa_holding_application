<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt__products', function (Blueprint $table) {
            $table->uuid('receipt_product_id')->primary();
            $table->uuid('receipt_id');
            $table->foreign('receipt_id')->references('id')->on('receipts');
            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('description')->nullable();
            $table->bigInteger('duration');
            $table->bigInteger('amount');
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
        Schema::dropIfExists('receipt__products');
    }
}
