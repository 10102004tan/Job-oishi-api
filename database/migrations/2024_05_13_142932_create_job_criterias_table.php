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
        Schema::create('job_criterias', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->uniqid();
            $table->text('job_position')->nullable();
            $table->text('job_location')->nullable();
            $table->text('job_salary')->nullable();
            $table->text('working_form')->nullable();
            $table->tinyInteger('is_remote')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_criterias');
    }
};
