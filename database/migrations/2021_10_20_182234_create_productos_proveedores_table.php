<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_proveedores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('productos_id')->unsigned();
            $table->foreign('productos_id')->references('id')->on('productos');
            $table->bigInteger('proveedores_id')->unsigned();
            $table->foreign('proveedores_id')->references('id')->on('proveedores');
            $table->float('precio', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos__proveedores');
    }
}
