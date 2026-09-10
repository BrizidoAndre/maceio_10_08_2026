<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id');
            $table->string('seat_code');
            $table->unique(['room_id', 'seat_code'], 'room_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('seats');
    }
};
