<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToUserEscolarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('user_escolars', function (Blueprint $table) {
        //     $table->unsignedBigInteger('role_id');
        //     $table->foreign('role_id')->references('id')->on('roles');
        // });

        Schema::table('user_escolars', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_escolars', function (Blueprint $table) {
            // $table->foreignId('role_id')
            //     ->constrained()
            //     ->onDelete('cascade');
            $table->dropConstrainedForeignId('user_id');
        });
    }
}
