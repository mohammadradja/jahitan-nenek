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
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('invoice_number')->unique()->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->integer('total_price');
            $table->integer('shipping_cost')->default(0);
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->string('order_status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('courier')->nullable();
            $table->string('tracking_number')->nullable();
            $table->text('notes')->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('completed_at')->nullable();
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
