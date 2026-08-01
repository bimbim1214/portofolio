<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('headline');
            $table->text('about_1')->nullable();
            $table->text('about_2')->nullable();
            $table->text('about_3')->nullable();
            $table->text('short_bio')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
