<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusesReimbursement;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('order_id');
            $table->float('total');
            $table->text('observation')->nullable();
            $table->enum('status', StatusesReimbursement::cases())->default(StatusesReimbursement::PENDING);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reimbursements');
    }
};
