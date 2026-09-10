<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('purchase_seats', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id');
            $table->foreignId('seat_id');
            $table->unique(['seat_id'], 'seat_id');
            $table->index(['purchase_id'], 'purchase_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_seats');
    }
};
