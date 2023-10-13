<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imcs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_aluno')->nullable();
            $table->double('peso');
            $table->double('altura');
            $table->double('imc');
            $table->string('grau_imc');
            $table->date('dia_acompanhado');
            $table->timestamps();


            $table->foreign('id_aluno')->references('id')->on('alunos')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imcs');
    }
}
