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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('chest', 8, 2)->nullable();
            $table->decimal('waist', 8, 2)->nullable();
            $table->decimal('hip', 8, 2)->nullable();
            $table->decimal('shoulder', 8, 2)->nullable();
            $table->decimal('sleeve_length', 8, 2)->nullable();
            $table->decimal('body_length', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
