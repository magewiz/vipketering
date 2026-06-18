<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('slug');                  // anchor id, e.g. meni-1
            $table->string('title');                 // Мени 1
            $table->string('group')->default('shvedska'); // shvedska | svecheni
            $table->string('group_label')->nullable();    // "Шведска маса"
            $table->string('price')->nullable();          // 550
            $table->string('price_unit')->default('ден.');
            $table->string('price_per')->default('/ особа');
            $table->string('note')->nullable();           // "+ Мени за деца ..."
            $table->json('dishes')->nullable();           // [{name, detail}]
            $table->json('included')->nullable();         // ["Чинии", ...]
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
