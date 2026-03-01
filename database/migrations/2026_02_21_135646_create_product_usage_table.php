<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_usage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('usage_id');
            $table->foreign('usage_id')->references('id')->on('usages');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_usage');
    }
};
