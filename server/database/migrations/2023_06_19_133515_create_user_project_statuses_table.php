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
        Schema::create('user_project_statuses', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('status_id');
            $table->integer('order');
            $table->integer('display_status');

            $table->primary(['user_id', 'status_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_project_statuses');
    }
};
