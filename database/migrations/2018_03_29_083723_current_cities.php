<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CurrentCities extends Migration
{
    public function up()
    {
        Schema::create('current_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alias');
            $table->string('slug')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('current_cities');
    }
}
