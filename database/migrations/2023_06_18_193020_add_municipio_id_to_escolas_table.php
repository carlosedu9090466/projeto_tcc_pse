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
        // Schema::table('escolas', function (Blueprint $table) {
        //     $table->unsignedBigInteger('localidade_id');
        //     $table->foreign('localidade_id')->references('id')->on('municipios');
        // });

        Schema::table('escolas', function (Blueprint $table) {
            // $table->foreign('localidade_id')->references('id')->on('municipios')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('CASCADE');

            $table->foreignId('localidade_id')->references('id')->on('municipios')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            // $table->foreignId('localidade_id')
            //     ->constrained()
            //     ->onDelete('cascade');
            //$table->dropForeign('localidade_id');
            $table->dropConstrainedForeignId('localidade_id');
        });
    }
}
