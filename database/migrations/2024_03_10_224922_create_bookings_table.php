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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_shows_id')->constrained('movie_shows');
            $table->foreignId('seat_id')->constrained('seats');
            $table->foreignId('user_id')->constrained('public_users');
            $table->date('booking_date');
            $table->string('payment_status')->default('unpaid')->comment('unpaid or paid');
            $table->string('reference_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
