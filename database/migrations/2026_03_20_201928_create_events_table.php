<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();

            $table->string('location')->nullable();

            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();

            $table->boolean('all_day')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
