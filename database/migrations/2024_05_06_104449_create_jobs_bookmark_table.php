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
        Schema::create('jobs_bookmark', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('user_id')->default(1);
            $table->string('title');
            $table->string('company_name');
            $table->string('company_logo');
            $table->string('sort_addresses');
            $table->integer('salary_min');
            $table->integer('salary_max');
            $table->boolean('is_salary_visible');
            $table->string('published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_bookmark');
    }
};
