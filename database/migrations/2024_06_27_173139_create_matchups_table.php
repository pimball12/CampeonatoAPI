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
        Schema::create('matchups', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreignId('championship_id')->references('id')->on('championships');
            $table->foreignId('team_1_id')->references('id')->on('users');
            $table->foreignId('team_2_id')->references('id')->on('users');
            $table->tinyInteger('team_1_goals')->default(0);
            $table->tinyInteger('team_2_goals')->default(0);
            $table->tinyInteger('phase')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchups');
    }
};
