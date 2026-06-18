<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->default('VIP Ketering');
            $table->string('tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('phone_primary')->nullable();
            $table->string('phone_primary_label')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('phone_secondary_label')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
