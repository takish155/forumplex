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
        Schema::table('questions', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('question_votes', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('answer_votes', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('question_votes', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('answer_votes', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
