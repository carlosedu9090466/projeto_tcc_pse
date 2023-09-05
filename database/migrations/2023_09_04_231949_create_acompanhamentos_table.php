<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcompanhamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acompanhamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_turma')->nullable();
            $table->unsignedBigInteger('id_aluno')->nullable();
            $table->unsignedBigInteger('id_agente')->nullable();
            $table->date('dia_observado');
            $table->string('observacao', 700);
            $table->string('status_acompanhamento', 100);
            $table->timestamps();

            $table->foreign('id_turma')->references('id')->on('turmas');
            $table->foreign('id_aluno')->references('id')->on('alunos');
            $table->foreign('id_agente')->references('id')->on('agentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acompanhamentos');
    }
}
