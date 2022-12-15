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
        Schema::create('seoranks', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->tinyInteger('core_domain')->default(1);
            $table->text('moz')->nullable();
            $table->text('semrush')->nullable();
            $table->text('facebook')->nullable();
            $table->longText('ahrefs')->nullable();

            $table->unsignedBigInteger('serprobot_id');
            $table->foreign('serprobot_id')->references('id')->on('serprobots');
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
        Schema::dropIfExists('seoranks');
    }
};
