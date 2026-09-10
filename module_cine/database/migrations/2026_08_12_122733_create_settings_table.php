<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('cashback_percent');
            $table->integer('cashback_validity_days');
            $table->integer('normal_ticket_price');
            $table->integer('vip_ticket_price');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
