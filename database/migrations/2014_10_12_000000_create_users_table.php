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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('NombreUsuario')->unique();
            $table->string('password');
            $table->string('Calle')->nullable();
            $table->string('NumExt')->nullable();
            $table->string('NumInt')->nullable();
            $table->string('Colonia')->nullable();
            $table->string('Localidad')->nullable();
            $table->string('Ciudad')->nullable();
            $table->string('CodigoPostal')->nullable();
            $table->string('Pais')->nullable();
            $table->smallInteger('Activado')->nullable()->default(1);
            $table->timestamp('email_verified_at')->nullable();
           
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
