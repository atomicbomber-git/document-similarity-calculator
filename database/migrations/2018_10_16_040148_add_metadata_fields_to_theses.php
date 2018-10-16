<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetadataFieldsToTheses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->string('student_name')->nullable();
            $table->string('student_id')->nullable();
            $table->string('study_program')->nullable();
            $table->date('seminar_date')->nullable();
            $table->string('advisor_1_name')->nullable();
            $table->string('advisor_2_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->dropColumn('student_name');
            $table->dropColumn('student_id');
            $table->dropColumn('study_program');
            $table->dropColumn('seminar_date');
            $table->dropColumn('advisor_1_name');
            $table->dropColumn('advisor_2_name');
        });
    }
}
