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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string("username");
            $table->string("avatar")->nullable();
            $table->text("about")->nullable();
        });

        Schema::create("questions", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("question_title");
            $table->text("question_description");
            $table->json("image_paths")->nullable();
            $table->boolean("is_solved")->default(false);
            $table->unsignedBigInteger("helpfull_message_id")->nullable();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });

        Schema::create("question_votes", function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("question_id");
            $table->boolean("is_helpful");

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("question_id")->references("id")->on("questions")->onDelete("cascade");
        });

        Schema::create("answers", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("question_id");

            $table->text("message");
            $table->json("image_paths")->nullable();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("question_id")->references("id")->on("questions")->onDelete("cascade");
        });

        Schema::create("answer_votes", function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("answer_id");
            $table->boolean("is_helpful");

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("answer_id")->references("id")->on("answers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn("username");
            $table->dropColumn("avatar");
            $table->dropColumn("about");
        });

        Schema::dropIfExists("question_votes");
        Schema::dropIfExists("answer_votes");
        Schema::dropIfExists("answers");
        Schema::dropIfExists("questions");
    }
};
