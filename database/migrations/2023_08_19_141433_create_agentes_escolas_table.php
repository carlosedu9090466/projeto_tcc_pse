<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentesEscolasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agentes_escolas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agente_id');
            $table->unsignedBigInteger('escola_id')->nullable();
            $table->boolean('status_agente_escola');
            $table->date('dia_lotado');
            $table->timestamps();

            $table->foreign('agente_id')->references('id')->on('agentes');
            $table->foreign('escola_id')->references('id')->on('escolas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agentes_escolas');
    }
}
