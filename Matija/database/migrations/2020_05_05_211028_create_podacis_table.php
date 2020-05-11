<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodacisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podacis', function (Blueprint $table) {
            $table->integer('korisnik_id')->primary();
            $table->string('ime');
            $table->string('prezime');
            $table->string('adresa');
            $table->string('grad');
            $table->string('brUlice');
            $table->string('brTelefona');
            $table->integer('ZIPCode');
            $table->string('metodNaplate');
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
        Schema::dropIfExists('podacis');
    }
}
