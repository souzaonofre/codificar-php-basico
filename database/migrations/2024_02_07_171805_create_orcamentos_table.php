<?php

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente');
            $table->foreignId('id_vendedor');

            $table->date('data')->default(Date::today(config('app.timezone'))->format('Y-m-d'));;
            $table->time('hora')->default(Date::today(config('app.timezone'))->format('H:i:s'));

            $table->text('descricao');

            $table->double('valor', 20, 2);

            $table->index('id_cliente', 'idx_cliente');
            $table->index('id_vendedor', 'idx_vendedor');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orcamentos');
    }
};
