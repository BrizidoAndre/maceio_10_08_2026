<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tax_brackets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lower_bound');
            $table->unsignedBigInteger('upper_bound')->nullable();
            $table->decimal('rate_percent');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax_brackets');
    }
};
