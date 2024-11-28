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
        Schema::table('answers', function (Blueprint $table) {
            //
            $table->string("question_image_path")->nullable();
            $table->dropColumn("image_paths");
        });

        Schema::table('questions', function (Blueprint $table) {
            //
            $table->string("question_image_path")->nullable();
            $table->dropColumn("image_paths");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            //
            $table->dropColumn("question_image_path");
            $table->json("image_paths")->nullable();
        });

        Schema::table('questions', function (Blueprint $table) {
            //
            $table->string("question_image_path")->nullable();
            $table->dropColumn("image_paths");
        });
    }
};
