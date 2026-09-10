<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cashback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('purchase_id');
            $table->integer('amount');
            $table->date('expires_at');
            $table->index(['customer_id'], 'customer_id');
            $table->index(['purchase_id'], 'purchase_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cashback');
    }
};
