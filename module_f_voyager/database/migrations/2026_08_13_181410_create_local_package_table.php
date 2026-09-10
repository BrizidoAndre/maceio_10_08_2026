<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('local_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id');
            $table->foreignId('local_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('local_package');
    }
};
