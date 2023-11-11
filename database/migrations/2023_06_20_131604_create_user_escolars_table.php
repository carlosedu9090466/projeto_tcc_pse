<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEscolarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_escolars', function (Blueprint $table) {
            $table->id();
            //$table->string('nome', 100);
            $table->char('cpf', 11)->unique();
            $table->string('telefone', 13);
            //$table->string('email', 100);
            $table->string('sexo');
            $table->string('genero');
            $table->date('data_nascimento');
            $table->boolean('ativo_user')->default(1);
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
        Schema::dropIfExists('user_escolars');
    }
}
