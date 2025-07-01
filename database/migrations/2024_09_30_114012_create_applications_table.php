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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('item_id');
            $table->string('price')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('withheld_amount')->nullable();
            $table->string('outstanding')->nullable();
            $table->string('refund_amount')->nullable();
            $table->string('status')->default('inactive');
            $table->string('delivery_status')->default('Not Delivered');
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
