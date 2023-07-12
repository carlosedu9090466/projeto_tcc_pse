<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoencaIdToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('questions', function (Blueprint $table) {
        //     $table->foreignId('doenca_id')->constrained();
        // });

        Schema::table('questions', function (Blueprint $table) {
            //$table->('doenca_id')->nullable();
            $table->foreignId('doenca_id')->references('id')->on('doencas')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            // $table->foreignId('doenca_id')
            //     ->constrained()
            //     ->onDelete('cascade');
            $table->dropConstrainedForeignId('doenca_id');
        });
    }
}
