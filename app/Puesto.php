<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table      = 'puesto';
    protected $primaryKey = 'Id';
    protected $fillable   = ['Descripcion', 'Estatus'];
    
    static function getById($id)
    {
        $puesto = Puesto::where('Id', $id)
            ->first();
        return $puesto;
    }

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

    static function drop($id)
    {
        $puesto = Puesto::where('Id', $id);
        $puesto->delete();
    }
}
