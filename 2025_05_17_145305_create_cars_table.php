<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('type'); // sedan, SUV, van, etc.
            $table->string('transmission'); // automatic, manual
            $table->string('color')->nullable();
            $table->integer('year')->nullable();
            $table->string('plate_number')->unique();
            $table->decimal('daily_rate', 8, 2);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('available')->default(true);
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};