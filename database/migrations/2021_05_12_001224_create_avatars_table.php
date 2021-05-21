<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvatarsTable extends Migration
{
    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('original_name');
            $table->string('path');
            $table->boolean('processed')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('avatars');
    }
}
