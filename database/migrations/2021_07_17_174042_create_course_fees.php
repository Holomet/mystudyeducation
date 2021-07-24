<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('college_course_id');
            $table->text('fee_details');
            $table->string('link_more_details', 100);
            $table->string('link_apply', 100);
            $table->boolean('status');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_fees', function (Blueprint $table) {
            //
        });
    }
}
