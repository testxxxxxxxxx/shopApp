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
        Schema::create('personal_data_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('lastname')->nullable(false);
            $table->string('street_name')->nullable(false);
            $table->string('hause_number')->nullable(false);
            $table->string('zip_code')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('country')->nullable(false);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('personal_data_users', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_data_users');
    }
};
