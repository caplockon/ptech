<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gallery_pictures', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('title')->nullable();
            $table->string('system_path');
            $table->text('description')->nullable();
            $table->integer('album_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_pictures');
    }
};
