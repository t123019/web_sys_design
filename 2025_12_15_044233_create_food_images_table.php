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
        Schema::create('food_images', function (Blueprint $table) {
            $table->id();
            $table->string('food_name'); //商品名
            $table->date('expiration_date')->nullable(); //賞味期限
            $table->string('storage_location')->nullable(); //保管場所
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_images');
    }
};
