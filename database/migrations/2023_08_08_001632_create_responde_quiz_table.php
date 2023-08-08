<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespondeQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responde_quiz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_aluno')->nullable();
            $table->unsignedBigInteger('id_turma')->nullable();
            $table->unsignedBigInteger('id_quiz')->nullable();
            $table->unsignedBigInteger('id_question')->nullable();
            $table->boolean('resposta_question');
            $table->date('data_resposta');
            $table->foreign('id_aluno')->references('id')->on('alunos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_turma')->references('id')->on('turmas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_quiz')->references('id')->on('quizs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_question')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('responde_quiz');
    }
}
