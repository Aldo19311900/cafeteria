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
        Schema::create('inventory_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('previous_stock'); // El stock anterior
            $table->integer('new_stock'); // El nuevo stock asignado
            $table->foreignId('admin_id')->constrained('users'); // El administrador que realizó el ajuste
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('inventory_adjustments');
    }
};
