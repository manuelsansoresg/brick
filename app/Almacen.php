<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table      = 'almacen';
    protected $primaryKey = 'Id';
    protected $fillable   = ['Descripcion', 'Encargado', 'Matriz', 'Estatus'];

    static function getById($id)
    {
        $almacen = Almacen::where('Id', $id)->first();
        return $almacen;
    }

    static function getAll()
    {
        $almacen = Almacen::all();
        return $almacen;
    }

    static function createUpdate($request, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;

        if ($id == null) {
            $almacen = new Almacen($request->except('_token'));
            $almacen->Estatus = $Estatus;
            $almacen->save();
        } else {
            $almacen = Almacen::find($id);
            $almacen->fill($request->except('_token'));
            $almacen->Estatus = $Estatus;
            $almacen->update();
        }
    }

    static function drop($id)
    {
        $almacen = Almacen::find($id);
        $almacen->delete();
    }

}
