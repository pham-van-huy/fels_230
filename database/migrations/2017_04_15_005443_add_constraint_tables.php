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
            $table->dropForeign('social_accounts_user_id_foreign');
        });

        Schema::table('words', function (Blueprint $table) {
            $table->dropForeign('words_category_id_foreign');
        });

        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign('results_lesson_id_foreign');
            $table->dropForeign('results_answer_id_foreign');
            $table->dropForeign('results_word_id_foreign');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign('lessons_user_id_foreign');
            $table->dropForeign('lessons_category_id_foreign');
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->integer('word_id')->change();
            $table->boolean('is_correct')->change();
        });
    }
}
