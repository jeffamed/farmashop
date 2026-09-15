<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_id');
            $table->string('type');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('stock_before');
            $table->unsignedInteger('stock_after');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->morphs('referenceable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kardexes');
    }
};
