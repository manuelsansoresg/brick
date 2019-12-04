<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table      = 'colores';
    protected $fillable   = ['Descripcion', 'Estatus', 'Abreviatura'];

    static function getAll()
    {
        $color = Color::all();
        return $color;
    }

    static function createUpdate($request, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;

        if ($id == null) {
            $color = new Color($request->except('_token'));
            $color->Estatus = $Estatus;
            $color->save();
        } else {
            $color = Color::find($id);
            $color->fill($request->except('_token'));
            $color->Estatus = $Estatus;
            $color->update();
        }
    }
}
