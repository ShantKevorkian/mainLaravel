<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfessions extends Migration
{

    public function up()
    {
        Schema::create('user_professions', function (Blueprint $table) {

            $table->foreignId('user_id')->constrained();
            $table->foreignId('profession_id')->constrained();
        });
    }

    public function down()
    {
        Schema::table('user_professions', function (Blueprint $table) {
            $table->dropColumn('user_professions');
        });
    }
}
