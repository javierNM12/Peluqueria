<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas_servicios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('citas_id')->unsigned();
            $table->foreign('citas_id')->references('id')->on('citas');
            $table->bigInteger('servicios_id')->unsigned();
            $table->foreign('servicios_id')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas__servicios');
    }
}
