<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps();
        });
        
        // Add the three specific branches as mentioned in the requirements
        DB::table('branches')->insert([
            [
                'name' => 'ECE Headquarters',
                'location' => 'Bandar Baru Bangi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ECE Branch',
                'location' => 'Shah Alam',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ECE Branch',
                'location' => 'Gombak',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};