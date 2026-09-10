<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code');
            $table->string('full_name');
            $table->string('email');
            $table->string('department');
            $table->unsignedBigInteger('base_salary');
            $table->date('employment_start_date');
            $table->enum('status', ['active', 'inactive']);
            $table->string('photo_path')->nullable();
            $table->timestamp('deactivated_at')->nullable();
            $table->timestamps();
            $table->unique(['employee_code'], 'employee_code');
            $table->unique(['email'], 'email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
