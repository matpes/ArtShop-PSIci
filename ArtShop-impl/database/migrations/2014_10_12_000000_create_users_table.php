<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('mail')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profilna_slika')->nullable();
            $table->integer('brPrijava')->default(0);
            $table->integer('brUspesnihPrijava')->default(0);
            $table->tinyInteger('isSlikar');
            $table->tinyInteger('isAdmin')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
