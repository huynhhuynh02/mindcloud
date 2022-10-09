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
        Schema::create('wiki_files', function (Blueprint $table) {
            $table->id();
            $table->text('media_url');
            $table->tinyInteger('media_type');
            $table->tinyInteger('file_size');
            $table->unsignedBigInteger('wiki_id');
            $table->foreign('wiki_id')->references('id')->on('wikis');
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
        Schema::dropIfExists('wiki_files');
    }
};
