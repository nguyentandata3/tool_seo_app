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
        Schema::create('tool_cms_data_serprobots', function (Blueprint $table) {
            $table->id();
            $table->string('serprobot_id');
            $table->string('position')->nullable();
            $table->longText('link_top_10');
            $table->text('found_serp')->nullable();
            $table->longText('competition_details')->nullable();

            $table->unsignedBigInteger('keyword_id');
            $table->foreign('keyword_id')->references('id')->on('tool_cms_keywords');
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
        Schema::dropIfExists('tool_cms_data_serprobots');
    }
};
