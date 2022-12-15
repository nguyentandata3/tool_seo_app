<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serprobots', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->string('domain');
            $table->string('position')->nullable();
            $table->string('found_serp')->nullable();
            $table->string('region');
            $table->longtext('top10');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('serprobots');
    }
};
