<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cbr extends Migration
{
    public function up()
    {
        Schema::create('cbr', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('value')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cbr');
    }
}
