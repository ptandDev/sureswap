<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CitiesRussia extends Migration
{
    public function up()
    {
        Schema::create('cities_russia', function (Blueprint $table) {
            $table->string('name')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities_russia');
    }
}
