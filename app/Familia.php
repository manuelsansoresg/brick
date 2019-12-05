<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $table      = 'familia';
    protected $primaryKey = 'Id';
    protected $fillable   = ['Descripcion', 'Estatus'];

    static function getById($id)
    {
        $familia = Familia::where('Id', $id)->first();
        return $familia;
    }

    static function getAll()
    {
        $familia = Familia::all();
        return $familia;
    }

    static function createUpdate($request, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;

        if ($id == null) {
            $familia = new Familia($request->except('_token'));
            $familia->Estatus = $Estatus;
            $familia->save();
        } else {
            $familia = Familia::find($id);
            $familia->fill($request->except('_token'));
            $familia->Estatus = $Estatus;
            $familia->update();
        }


    }

    static function drop($id)
    {
        $familia = Familia::find($id);
        $familia->delete();
    }

}