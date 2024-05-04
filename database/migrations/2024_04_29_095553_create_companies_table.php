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
        Schema::create('companies', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->text('display_name')->nullable();
            $table->string('image_logo')->nullable();
            $table->longText('description')->nullable();
            $table->string('website')->nullable();
            $table->text('tagline')->nullable();
            $table->string('company_size')->nullable();
            // $table->string('address_region_id')->nullable();
            $table->integer('num_job_openings')->nullable();
            $table->string('nationality_id')->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
