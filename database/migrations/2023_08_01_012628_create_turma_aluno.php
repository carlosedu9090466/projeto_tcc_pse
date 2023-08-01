<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmaAluno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turma_aluno', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_aluno');
            $table->foreign('id_aluno')->references('id')->on('alunos')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_turma');
            $table->foreign('id_turma')->references('id')->on('turmas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('n_chamada')->nullable();
            $table->string('status_aluno_turma')->default('Matriculado');
            $table->date('dt_matricula');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turma_aluno');
    }
}
