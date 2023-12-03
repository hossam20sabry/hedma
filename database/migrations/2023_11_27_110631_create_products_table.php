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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('kind_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->bigInteger('times_sold')->nullable();
            $table->string('image');
            $table->foreign('category_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('kind_id')->references('id')->on('kinds')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
