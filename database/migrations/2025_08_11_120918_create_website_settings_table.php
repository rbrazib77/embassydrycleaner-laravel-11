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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('company_name')->nullable(); 
            $table->text('footer_description')->nullable(); 
            $table->string('phone')->nullable();
            $table->string('email')->nullable(); 
            $table->string('address')->nullable();
            $table->string('working_time')->nullable(); 
            $table->string('copy_right')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
