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
            $table->text('company_name');
            $table->string('company_image');
            $table->longText('description');
            $table->string('website');
            $table->text('tagline');
            $table->integer('company_size');
            $table->string('address_region_id');
            $table->integer('number_job_opening');
            $table->string('benifits_id');
            $table->string('nationallity_id');
            $table->timestamp('created_at')->useCurrent();
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
