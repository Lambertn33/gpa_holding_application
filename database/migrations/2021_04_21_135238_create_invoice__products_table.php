<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice__products', function (Blueprint $table) {
            $table->uuid('invoice_product_id')->primary();
            $table->uuid('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('invoice__products');
    }
}
