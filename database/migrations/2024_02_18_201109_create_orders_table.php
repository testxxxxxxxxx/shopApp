<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->date('date');
            $table->bigInteger('from')->unsigned();
            $table->bigInteger('to_customer')->unsigned();
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('from')->references('id')->on('users');
            $table->foreign('to_customer')->references('id')->on('users');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
