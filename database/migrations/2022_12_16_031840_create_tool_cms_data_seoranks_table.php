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
        Schema::create('tool_cms_data_seoranks', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->tinyInteger('cate')->default(1)->comment('1: Link đối thủ, 2: Link mình');
            $table->longtext('moz')->nullable();
            $table->longtext('semrush')->nullable();
            $table->longtext('facebook')->nullable();
            $table->longtext('ahrefs')->nullable();

            $table->unsignedBigInteger('data_serprobot_id');
            $table->foreign('data_serprobot_id')->references('id')->on('tool_cms_data_serprobots');
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
        Schema::dropIfExists('tool_cms_data_seoranks');
    }
};
