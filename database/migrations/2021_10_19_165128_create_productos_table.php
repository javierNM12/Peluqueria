<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->bigInteger('minimo');
            $table->float('pvp', 8,2)->nullable(); // permitimos que pueda ser null porque los productos de consumo propio no tienen PVP
            $table->tinyInteger('tipo'); // -> 0 para los productos de consumo propio | -> 1 para los productos de venta
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
