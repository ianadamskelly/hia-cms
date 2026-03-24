<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_inquiries', function (Blueprint $table) {
            $table->id();

            $table->string('parent_name');
            $table->string('student_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('programme_interest')->nullable();
            $table->string('campus_interest')->nullable();

            $table->text('message')->nullable();

            $table->string('status')->default('new');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_inquiries');
    }
};
