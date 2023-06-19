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
        Schema::create('project_tasks', function (Blueprint $table) {

            $table->id();
            $table->uuid();
            $table->string('name');
            $table->longText('description');
            $table->integer('project_id');
            $table->integer('creator_id');
            $table->integer('assignee_id')->nullable();
            $table->integer('priority_id');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['uuid']);
            $table->index(['project_id', 'assignee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tasks');
    }
};
