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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('job_name');
            $table->foreignId('job_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('experience_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('vacancy');            
            $table->string('salary')->nullable();
            $table->string('location');
            $table->longText('description')->nullable();
            $table->longText('benefit')->nullable();
            $table->longText('responsibility')->nullable();
            $table->string('qualification')->nullable();
            $table->string('keyword');
            $table->string('company_name');
            $table->string('company_location');
            $table->string('company_website');
            $table->string('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
