<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table      = 'marca';
    protected $fillable   = ['Descripcion', 'Estatus'];

    static function getAll()
    {
        $marca = Marca::all();
        return $marca;
    }

    static function createUpdate($request, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;

        if ($id == null) {
            $marca = new Marca($request->except('_token'));
            $marca->Estatus = $Estatus;
            $marca->save();
        } else {
            $marca = Marca::find($id);
            $marca->fill($request->except('_token'));
            $marca->Estatus = $Estatus;
            $marca->update();
        }
    }
}
