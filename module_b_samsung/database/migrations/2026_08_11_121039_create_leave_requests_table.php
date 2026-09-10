<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->unsignedInteger('leave_type_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled']);
            $table->unsignedInteger('effective_days')->nullable();
            $table->string('rejection_note')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            $table->index(['employee_id'], 'employee_id');
            $table->index(['leave_type_id'], 'leave_type_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_requests');
    }
};
