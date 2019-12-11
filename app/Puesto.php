<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table      = 'puesto';
    protected $fillable   = ['Descripcion', 'Estatus'];

    static function getAll()
    {
        $puesto = Puesto::all();
        return $puesto;
    }

    static function createUpdate($request, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;

        if ($id == null) {
            $puesto = new Puesto($request->except('_token'));
            $puesto->Estatus = $Estatus;
            $puesto->save();
        } else {
            $puesto = Puesto::find($id);
            $puesto->fill($request->except('_token'));
            $puesto->Estatus = $Estatus;
            $puesto->update();
        }
    }
}
