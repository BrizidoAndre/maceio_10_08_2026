<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id');
            $table->foreignId('room_id');
            $table->datetime('session_date');
            $table->index(['movie_id'], 'movie_id');
            $table->index(['room_id'], 'room_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};
