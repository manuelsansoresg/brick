<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table      = 'departamento';
    protected $primaryKey = 'Id';
    protected $fillable   = ['Descripcion', 'Estatus'];


    static function getById($id)
    {
        $departamento = Departamento::where('Id', $id)
                        ->first();
        return $departamento;
    }

    static function getAll()
    {
        $departamento = Departamento::all();
        return $departamento;
    }

    static function createUpdate($request, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;

        if ($id == null) {
            $departamento = new Departamento($request->except('_token'));
            $departamento->Estatus = $Estatus;
            $departamento->save();
        } else {
            $departamento = Departamento::find($id);
            $departamento->fill($request->except('_token'));
            $departamento->Estatus = $Estatus;
            $departamento->update();
        }

        return $departamento;
    }

    static function drop($id)
    {
        $departamento = Departamento::where('Id', $id);
        $departamento->delete();
    }
}
