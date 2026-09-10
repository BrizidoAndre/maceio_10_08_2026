<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');
            $table->unsignedInteger('working_days');
            $table->unsignedInteger('effective_leave_days');
            $table->unsignedBigInteger('gross_salary');
            $table->unsignedBigInteger('monthly_tax');
            $table->unsignedBigInteger('net_salary');
            $table->timestamp('generated_at');
            $table->timestamps();
            $table->unique(['employee_id', 'year', 'month'], 'unique_employee_month');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payslips');
    }
};
