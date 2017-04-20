<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintTables extends Migration
{

    public function up()
    {
        Schema::table('social_accounts', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade')->change();
        });

        Schema::table('words', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade')->change();
        });

        Schema::table('results', function (Blueprint $table) {
            $table->foreign('lesson_id')
                ->references('id')->on('lessons')
                ->onDelete('cascade')->onUpdate('cascade')->change();
            $table->foreign('answer_id')
                ->references('id')->on('answers')
                ->onDelete('cascade')->onUpdate('cascade')->change();
            $table->foreign('word_id')
                ->references('id')->on('words')
                ->onDelete('cascade')->onUpdate('cascade')->change();
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade')->change();
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade')->change();
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->integer('word_id')->unsigned()->change();
            $table->boolean('is_correct')
                ->default(config('settings.answer.not_correct_answer'))
                ->change();
        });
    }

    public function down()
    {
        Schema::table('social_accounts', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });

        Schema::table('words', function (Blueprint $table) {
            $table->dropForeign('category_id');
        });

        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign('lesson_id');
            $table->dropForeign('answer_id');
            $table->dropForeign('word_id');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('category_id');
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->integer('word_id')->change();
            $table->boolean('is_correct')->change();
        });
    }
}
