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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con usuarios (alumnos)
            $table->decimal('balance', 10, 2); // El saldo de crédito disponible
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('credits');
    }
    
};
