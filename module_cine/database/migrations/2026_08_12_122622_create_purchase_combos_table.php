<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('purchase_combos', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id');
            $table->foreignId('combo_id');
            $table->integer('quantity');
            $table->index(['purchase_id'], 'purchase_id');
            $table->index(['combo_id'], 'combo_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_combos');
    }
};
