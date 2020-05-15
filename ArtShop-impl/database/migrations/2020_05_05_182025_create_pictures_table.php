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
            $table->id()->autoIncrement();
            $table->integer('korisnik_id');
            $table->string('autor');
            $table->integer('stil_id');
            $table->string('path');
            $table->string('smer');
            $table->string('naziv');
            $table->integer('ocena')->nullable();
            $table->string('opis');
            $table->integer('aukcijaFlag');
            $table->date('danIstekaAukcije')->nullable();
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
