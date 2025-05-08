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
            $table->string('customer_id');
            $table->string('customer_name');
            $table->string('item_name');
            $table->string('price');
            $table->string('serial_number')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('withheld_amount')->nullable();
            $table->string('outstanding');
            $table->string('refund_amount')->nullable();
            $table->string('created_by');
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
