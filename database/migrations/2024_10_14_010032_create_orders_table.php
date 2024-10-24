<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el alumno
            $table->decimal('total', 8, 2); // Total de la orden
            $table->enum('status', ['pending', 'preparing', 'completed', 'cancelled'])->default('pending'); // Estado de la orden
            $table->timestamp('waiting_time')->nullable(); // Tiempo de espera para la orden
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
