<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table      = 'unidad';
    protected $primaryKey = 'Id';
    protected $fillable   = ['Descripcion', 'Abreviatura', 'Estatus'];

    static function getAll()
    {
        $unidad = Unidad::all();
        return $unidad;
    }

    static function createUpdate($request , $id=null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;

        if( $id == null ){
            $unidad = new Unidad($request->except('_token'));
            $unidad->Estatus = $Estatus;
            $unidad->save();
        }else{
            $unidad = Unidad::find($id);
            $unidad->fill($request->except('_token'));
            $unidad->Estatus = $Estatus;
            $unidad->update();
        }
    }
}
