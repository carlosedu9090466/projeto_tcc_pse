<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escola_id')->nullable();
            $table->foreign('escola_id')->references('id')->on('escolas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('serie', 50);
            $table->string('turno', 50);
            $table->string('ano', 4);
            $table->boolean('status_turma');
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
        Schema::dropIfExists('turmas');
    }
}
