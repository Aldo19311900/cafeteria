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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity'); // Cantidad del producto en la orden
            $table->decimal('price', 8, 2); // Precio del producto en el momento de la compra
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
    
};
