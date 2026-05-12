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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->string('product_name')->after('product_id');
            $table->decimal('product_price', 15, 2)->after('product_name');
            $table->decimal('subtotal', 15, 2)->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('price')->after('quantity');
            $table->dropColumn(['product_name', 'product_price', 'subtotal']);
        });
    }
};
