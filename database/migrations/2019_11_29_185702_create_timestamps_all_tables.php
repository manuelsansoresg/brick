<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimestampsAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('almacen', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('articulo', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('clientes', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('colores', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('configuraciondelsistema', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('departamento', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('detalleentrada', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('detallepedido', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('detalleproducion', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('detallesalida', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('empleado', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('entradas', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('familia', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('movimiento', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('pedido', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('produccion', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('proveedores', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('puesto', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('salida', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('unidad', function (Blueprint $table) {
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
        Schema::table('almacen', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('articulo', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('colores', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('configuraciondelsistema', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('departamento', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('detalleentrada', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('detallepedido', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('detalleproducion', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('detallesalida', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('empleado', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('entradas', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('familia', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('movimiento', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('pedido', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('produccion', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('puesto', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('salida', function (Blueprint $table) {
            $table->dropTimestamps();
        });
        Schema::table('unidad', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
