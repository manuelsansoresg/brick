<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoModelo extends Model
{
    protected $table      = 'tipo_modelo';
    protected $fillable   = ['descripcion', 'Estatus'];

    static function getAll()
    {
        $modelo = TipoModelo::all();
        return $modelo;
    }
}
