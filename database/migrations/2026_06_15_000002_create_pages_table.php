<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();      // home, about, menia, oprema, contact
            $table->string('title');               // admin-facing label
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->json('content')->nullable();   // structured, schema-driven page content
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
