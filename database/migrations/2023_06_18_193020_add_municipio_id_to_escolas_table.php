<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMunicipioIdToEscolasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escolas', function (Blueprint $table) {
            $table->unsignedBigInteger('localidade_id');
            $table->foreign('localidade_id')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escolas', function (Blueprint $table) {
            $table->foreignId('localidade_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }
}
