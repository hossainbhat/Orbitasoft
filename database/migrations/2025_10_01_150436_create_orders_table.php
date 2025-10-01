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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('delivery_info_id')->constrained('delivery_infos')->cascadeOnDelete(); 
            $table->decimal('subtotal', 10, 2);  
            $table->decimal('discount', 10, 2)->default(0); 
            $table->decimal('tax', 10, 2)->default(0);     
            $table->decimal('total', 10, 2); 
            $table->string('status')->default('pending'); 
            $table->string('payment_method')->nullable(); 
            $table->string('transaction_id')->nullable(); 
            $table->timestamps();
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
