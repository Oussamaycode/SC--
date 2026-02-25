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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('colocation_id')->constrained();
            $table->timestamps();
        });
    }

    //A membership gets canceled automatically when removing a member from the colocation

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }


};
