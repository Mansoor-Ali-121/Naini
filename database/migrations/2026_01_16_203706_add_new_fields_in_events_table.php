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
        Schema::table('events', function (Blueprint $table) {
            $table->dateTime('date')->nullable()->after('description');
            $table->string('location')->nullable()->after('date');

            // In columns ko ek logical sequence mein rakha gaya hai
            $table->string('category')->nullable()->after('location');
            $table->string('host_name')->nullable()->after('category');
            $table->string('organizer')->nullable()->after('host_name');
            $table->string('slug')->unique()->after('name');
            $table->integer('guests')->nullable()->after('organizer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                // 'date',  // Agar aap date column ko drop karna chahte hain to is line ko uncomment karein
                'location',
                'category',
                'host_name',
                'organizer',
                'slug',
                'guests'
            ]);
        });
    }
};
