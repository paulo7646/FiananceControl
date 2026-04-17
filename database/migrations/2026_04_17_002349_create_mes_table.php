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
        Schema::create('mes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('despesa', 10, 2)->default(0);
            $table->decimal('renda', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->foreignId('ano_id')->constrained('anos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mes');
    }
};
