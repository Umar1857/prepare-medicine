<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlabCoursesAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plab_courses', function (Blueprint $table) {
            $table->boolean('is_online')->after('lectures')->nullable();
            $table->boolean('is_paid')->after('is_online')->nullable();

            $table->dropColumn('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plab_courses', function (Blueprint $table) {
            $table->dropColumn('is_online');
            $table->dropColumn('is_paid');

            $table->string('level')->nullable();
        });
    }
}
