<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollege extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 250);
            $table->string('logo', 250);
            $table->string('rollup_banner', 250)->nullable();
            $table->string('stall_video', 250)->nullable();
            $table->text('about')->nullable();
            $table->string('prospectus', 250)->nullable();
            $table->boolean('status');
            $table->unsignedInteger('user_id');
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
        Schema::table('colleges', function (Blueprint $table) {
            //
        });
    }
}
