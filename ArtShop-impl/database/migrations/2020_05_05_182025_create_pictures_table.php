<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->integer('korisnik_id');
            $table->string('autor');
            $table->integer('stil_id');
            $table->string('path');
            $table->string('smer');
            $table->string('naziv');
            $table->integer('ocena');
            $table->string('opis');
            $table->integer('aukcijaFlag');
            $table->date('danIstekaAukcije');
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
        Schema::dropIfExists('pictures');
    }
}
