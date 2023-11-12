<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('nome_pai', 100);
            $table->string('nome_mae', 100);
            $table->string('rua', 50);
            $table->string('bairro', 50);
            $table->string('numero', 10);
            $table->string('cpf_aluno', 11)->unique();
            $table->string('cpf_responsavel', 11);
            $table->date('dataNascimento');
            $table->string('sexo', 20);
            $table->string('genero');
            $table->string('inep', 20);
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
        Schema::dropIfExists('alunos');
    }
}
