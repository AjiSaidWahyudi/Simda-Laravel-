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
        Schema::create('gambar_inv', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inv_id');
            $table->string('gambar');
            $table->foreign('inv_id')->references('id')->on('inventarisasi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_inv');
    }
};
