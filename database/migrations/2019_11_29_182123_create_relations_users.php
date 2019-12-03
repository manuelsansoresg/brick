<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * pedido
     * entrada
     * salida
     * producion
     */
    public function up()
    {
        Schema::table('pedido', function (Blueprint $table) {
            $table->bigInteger('IdUsuario')->unsigned()->nullable()->after('Estatus');
            $table->foreign('IdUsuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('entradas', function (Blueprint $table) {
            $table->bigInteger('IdUsuario')->unsigned()->nullable()->after('Observaciones');
            $table->foreign('IdUsuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('salida', function (Blueprint $table) {
            $table->bigInteger('IdUsuario')->unsigned()->nullable()->after('Estatus');
            $table->bigInteger('IdUsuarioCancela')->unsigned()->nullable()->after('IdUsuario');
            
            $table->foreign('IdUsuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IdUsuarioCancela')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido', function (Blueprint $table) {
            $table->dropColumn('IdUsuario');
        });
        Schema::table('entradas', function (Blueprint $table) {
            $table->dropColumn('IdUsuario');
        });
        Schema::table('salida', function (Blueprint $table) {
            $table->dropColumn('IdUsuario');
            $table->dropColumn('IdUsuarioCancela');
        });
    }
}
