<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('session_id');
            $table->integer('subtotal');
            $table->integer('total');
            $table->integer('wallet_amount');
            $table->integer('card_amount');
            $table->integer('cashback_amount');
            $table->string('status');
            $table->datetime('purchased_at');
            $table->index(['customer_id'], 'customer_id');
            $table->index(['session_id'], 'session_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
