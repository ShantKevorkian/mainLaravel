<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostProfessionsTable extends Migration
{
    public function up()
    {
        Schema::create('post_professions', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained();
            $table->foreignId('profession_id')->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_professions');
    }
}
