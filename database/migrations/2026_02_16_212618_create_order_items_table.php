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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // orders table ke sath relationship
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            // menu table ke sath relationship (Aapke table ka naam 'menus' hai ya 'menu' wo check karlein)
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');

            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Order ke waqt ki price (taki baad mein menu price change ho to record kharab na ho)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
