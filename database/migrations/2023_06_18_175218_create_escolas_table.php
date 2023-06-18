<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscolasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escolas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 130);
            $table->string('inep', 20);
            $table->string('rua', 100);
            $table->string('bairro', 100);
            $table->string('numero', 20)->nullable();
            //entra como municipio - localidade - os 52
            //$table->string('localidade', 100);
            $table->string('cep', 11)->nullable();
            $table->boolean('rural')->default(0);
            $table->string('telefone', 20);
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
        Schema::dropIfExists('escolas');
    }
}
