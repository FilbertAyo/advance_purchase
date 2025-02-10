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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->String('item_name');
            $table->text('description');
            $table->string('cost')->nullable();
            $table->string('sales');
            $table->string('category');
            $table->string('brand');
            $table->string('code');
            $table->string('expire_date')->nullable();
            $table->string('created_by');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
