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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('invoice_number')->nullable()->unique()->after('id');
            $table->decimal('shipping_cost', 15, 2)->default(0)->after('total_price');
            $table->string('shipping_status')->default('pending')->after('status');
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('courier')->nullable()->after('payment_method');
            $table->string('tracking_number')->nullable()->after('courier');
            $table->text('notes')->nullable()->after('snap_token');
            $table->timestamp('paid_at')->nullable()->after('notes');
            $table->timestamp('shipped_at')->nullable()->after('paid_at');
            $table->timestamp('completed_at')->nullable()->after('shipped_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'invoice_number', 'shipping_cost', 'shipping_status', 
                'payment_method', 'courier', 'tracking_number', 
                'notes', 'paid_at', 'shipped_at', 'completed_at'
            ]);
        });
    }
};
