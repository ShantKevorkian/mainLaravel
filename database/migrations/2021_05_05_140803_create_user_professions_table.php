<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfessionsTable  extends Migration
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
        Schema::dropIfExists('user_professions');
    }
}
