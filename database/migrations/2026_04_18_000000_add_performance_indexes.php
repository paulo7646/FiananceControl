<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adiciona índices nas foreign keys para acelerar consultas
     * frequentes de agregação e filtragem.
     */
    public function up(): void
    {
        Schema::table('despesas', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('categoria_id');
            $table->index('mes_id');
            $table->index('ano_id');
            $table->index(['user_id', 'mes_id']);
            $table->index(['user_id', 'ano_id']);
        });

        Schema::table('rendas', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('categoria_id');
            $table->index('mes_id');
            $table->index('ano_id');
            $table->index(['user_id', 'mes_id']);
            $table->index(['user_id', 'ano_id']);
        });

        Schema::table('despesa_fixas', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('categoria_id');
        });

        Schema::table('renda_fixas', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('categoria_id');
        });

        Schema::table('mes', function (Blueprint $table) {
            $table->index('ano_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('despesas', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['categoria_id']);
            $table->dropIndex(['mes_id']);
            $table->dropIndex(['ano_id']);
            $table->dropIndex(['user_id', 'mes_id']);
            $table->dropIndex(['user_id', 'ano_id']);
        });

        Schema::table('rendas', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['categoria_id']);
            $table->dropIndex(['mes_id']);
            $table->dropIndex(['ano_id']);
            $table->dropIndex(['user_id', 'mes_id']);
            $table->dropIndex(['user_id', 'ano_id']);
        });

        Schema::table('despesa_fixas', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['categoria_id']);
        });

        Schema::table('renda_fixas', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['categoria_id']);
        });

        Schema::table('mes', function (Blueprint $table) {
            $table->dropIndex(['ano_id']);
        });
    }
};

