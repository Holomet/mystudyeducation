<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCountryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('country_iso');
            $table->dropColumn('country_name');
            $table->dropColumn('country_nicename');
            $table->dropColumn('country_iso3');
            $table->dropColumn('country_numcode');
            $table->dropColumn('country_phonecode');
            $table->string('name', 100)->after('id');
            $table->boolean('status')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            //
        });
    }
}
