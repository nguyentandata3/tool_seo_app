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
        Schema::create('tool_cms_projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id');
            $table->string('name');
            $table->string('region');
            $table->string('url');
            $table->tinyInteger('number_of_keywords');
            $table->text('competitors')->nullable();
            $table->text('notes')->nullable();
            $table->text('tags')->nullable();

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
        Schema::dropIfExists('tool_cms_projects');
    }
};
