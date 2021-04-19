<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proformas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('client_id');
            $table->string('status')->nullable();
            $table->string('product');
            $table->string('description');
            $table->date('date');
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
        Schema::dropIfExists('proformas');
    }
}
