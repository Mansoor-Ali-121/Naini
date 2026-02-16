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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Kis user ne order kiya (users table se link)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->decimal('total_amount', 10, 2);
            $table->string('payment_status')->default('pending'); // pending, paid, failed

            // Stripe transaction ID aur payment details
            $table->string('stripe_id')->nullable();
            $table->text('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
