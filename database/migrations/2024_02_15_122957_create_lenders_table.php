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
        Schema::create('lenders', function (Blueprint $table) {
            $table->id();
            $table->string('ownerName');
            $table->string('carModel');
            $table->integer('vehicleCount');
            $table->unsignedBigInteger('reg_id');
            $table->timestamps();

            // Add a foreign key constraint to link reg_id to the 'regs' table

            $table->foreign('reg_id')->references('id')->on('regs');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lenders');
    }
};
