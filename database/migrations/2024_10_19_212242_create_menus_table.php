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
        // 'table' ki jagah 'create' use karein
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Jo jo columns menus mein pehle thay wo yahan likhein
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('menu_picture')->nullable();

            // Ab aapke naye columns
            $table->string('actual_slug')->unique();

            // Foreign Keys
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained('sub_categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
