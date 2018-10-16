<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdvisorIdFieldsToTheses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->string('advisor_1_id')->nullable()->before('advisor_1_name');
            $table->string('advisor_2_id')->nullable()->before('advisor_2_name');
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
            $table->dropColumn('advisor_1_id');
            $table->dropColumn('advisor_2_id');
        });
    }
}
