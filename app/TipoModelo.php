<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoModelo extends Model
{
    protected $table      = 'tipo_modelo';
    protected $fillable   = ['descripcion', 'Estatus'];

    static function getById($id)
    {
        $familia = TipoModelo::where('id', $id)->first();
        return $familia;
    }

    static function getAll()
    {
        $modelo = TipoModelo::all();
        return $modelo;
    }

    static function createUpdate($request, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;

        if ($id == null) {
            $modelo = new TipoModelo($request->except('_token'));
            $modelo->Estatus = $Estatus;
            $modelo->save();
        } else {
            $modelo = TipoModelo::find($id);
            $modelo->fill($request->except('_token'));
            $modelo->Estatus = $Estatus;
            $modelo->update();
        }
    }

    static function drop($id)
    {
        $modelo = TipoModelo::find($id);
        $modelo->delete();
    }
}
