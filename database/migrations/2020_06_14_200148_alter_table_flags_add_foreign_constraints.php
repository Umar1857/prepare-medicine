<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFlagsAddForeignConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flags', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('ques_id')->nullable()->change();
            $table->foreign('ques_id')->references('id')->on('questions')->onDelete('cascade');

            $table->unsignedBigInteger('cat_id')->nullable()->change();
            $table->foreign('cat_id')->references('id')->on('categoties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flags', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['ques_id']);
            $table->dropForeign(['cat_id']);
        });
    }
}
