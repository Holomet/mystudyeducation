<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCollageTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('college_courses', 'collage_courses');
        Schema::rename('college_galleries', 'collage_galleries');
        Schema::rename('college_gallery_images', 'collage_gallery_images');
        Schema::rename('college_videos', 'collage_videos');
        Schema::rename('college_zones', 'collage_zones');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colleges', function (Blueprint $table) {
            //
        });
    }
}
