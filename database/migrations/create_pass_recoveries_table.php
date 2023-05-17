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
        Schema::create('pass_recoveries', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->boolean('used');
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('Accounts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pass_recoveries');
    }
};
