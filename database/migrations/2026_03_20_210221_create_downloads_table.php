<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->string('file_path')->nullable();
            $table->string('original_name')->nullable();
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
