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
        Schema::create('jobs_applied', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('user_id')->default(1);
            $table->primary(['id', 'user_id']);
            $table->string('title');
            $table->string('company_id');
            $table->string('company_name');
            $table->text('company_logo');
            $table->string('sort_addresses');
            $table->string('salary_min')->default('*');
            $table->string('salary_max')->default('*');
            $table->boolean('is_applied');
            $table->boolean('is_salary_visible');
            $table->string('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_applied');
    }
};
