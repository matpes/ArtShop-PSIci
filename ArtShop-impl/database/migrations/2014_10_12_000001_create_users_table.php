<?php

use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**php artisan migrate:refresh --seed
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('isSlikar')->default(false);
            $table->string('profilna_slika')->nullable();
            $table->integer('brPrijava')->default(0);
            $table->boolean('isAdmin')->default(false);
            $table->integer('brUspesnihPrijava')->default(0);
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
