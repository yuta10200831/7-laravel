<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAutoincrementFromFavoritesId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('id');
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->bigInteger('id')->first();
            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
        });
    }
}