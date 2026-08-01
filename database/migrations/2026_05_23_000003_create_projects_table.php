<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->string('title');
            $table->string('made_at')->nullable();
            $table->string('url')->nullable();
            $table->string('link_label')->nullable();
            $table->text('description')->nullable();
            $table->json('tags')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('show_on_home')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
