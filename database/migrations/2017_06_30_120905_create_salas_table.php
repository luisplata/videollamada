<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("nombre_sala")->unique();
            $table->datetime("fecha_hora_inicio");
            $table->datetime("fecha_hora_final")->nullable();
            $table->integer("empresas_id")->unsigned();
            $table->foreign('empresas_id')
            ->references('id')->on('empresas')
            ->onDelete('cascade');
            $table->enum("estado",["abierto","cerrado"])->default("abierto");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salas');
    }
}
