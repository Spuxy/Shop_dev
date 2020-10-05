<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammingLanguageLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programming_language_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repository_id');
            $table->foreign('repository_id')->references('id')->on('repositories');
            $table->unsignedBigInteger('programming_language_id');
            $table->foreign('programming_language_id')->references('id')->on('programming_languages');
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
        Schema::dropIfExists('programming_language_links');
    }
}
