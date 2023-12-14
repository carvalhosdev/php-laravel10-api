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
        Schema::create('englishes', function (Blueprint $table) {
            $table->id();
            $table->string("phrase");
            $table->string("translate")->nullable();
            $table->string("audio")->nullable();
            $table->string("image")->nullable();
            $table->string("explanation")->nullable();
            $table->integer("user_id");
            $table->unsignedBigInteger("card_id");
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
            $table->date("remember_at")->default(now()->addDays(3));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('englishes');
    }
};
