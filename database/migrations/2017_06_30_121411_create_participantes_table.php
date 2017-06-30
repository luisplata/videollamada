<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("nombre")->nullable();
            $table->enum("estado",["activo","inactivo"])->default("activo");
            $table->integer("salas_id")->unsigned();
            $table->foreign('salas_id')
            ->references('id')->on('salas')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participantes');
    }
}
