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
        Schema::create('tool_cms_keywords', function (Blueprint $table) {
            $table->id();
            $table->integer('serprobot_keyword_id');
            $table->string('keyword');
            $table->string('first_position')->nullable();
            $table->string('best_position')->nullable();
            $table->string('current_position')->nullable();
            $table->string('latest_change')->nullable();
            $table->string('latest_found_serp')->nullable();
            $table->timeTz('last_checked');

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('tool_cms_projects');
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
        Schema::dropIfExists('tool_cms_keywords');
    }
};
