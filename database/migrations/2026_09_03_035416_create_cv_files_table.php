<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cv_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');            // path relatif ke public/, e.g. "pdf/cv_123.pdf"
            $table->string('original_name');         // nama asli file waktu upload
            $table->unsignedBigInteger('file_size')->nullable(); // ukuran dalam bytes
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cv_files');
    }
};
