<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->string('collection');        // home-food, menia, oprema
            $table->string('src');               // /img/food-01.jpg or /storage/uploads/...
            $table->string('alt')->nullable();
            $table->string('caption')->nullable();
            $table->string('aspect')->nullable(); // optional layout hint: square, 3/4, 4/5
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
    }
};
