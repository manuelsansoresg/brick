<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacoraProduccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora_produccion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('produccion_id')->unsigned()->nullable();
            $table->bigInteger('detalle_pedido_id')->unsigned()->nullable();
            $table->smallInteger('etapa')->default(1);
            $table->integer('total')->nullable()->default(0)->comment('cantidad de productos totales');
            $table->integer('cantidad')->nullable()->default(0)->comment('suma de las cantidades guardadas');
            $table->integer('cantidad__malo')->nullable()->default(0)->comment('suma cantidad malo');
            $table->smallInteger('status')->default(0)->nullable();
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
        Schema::dropIfExists('bitacora_produccion');
    }
}
