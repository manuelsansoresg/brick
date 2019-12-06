<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table      = 'articulo';
    protected $fillable   = ['ClaveInterna', 'Nombre', 'Modelo', 'IdColor', 'IdFamilia', 'IdProveedor', 'IdUnidadCompra', 'stockmaximo', 'stockMinimo', 'Precio1', 'Precio2', 'Precio3', 'codigobarra', 'PrecioCosto', 'Observaciones', 'Idusuario', 'imagen', 'Estatus'];

    static function getById($id)
    {
        $articulo = Articulo::where('id', $id)->first();
        return $articulo;
    }

    static function getAll()
    {
        $articulo = Articulo::all();
        return $articulo;
    }

    static function createUpdate($request, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;

        if ($id == null) {
            $articulo = new Articulo($request->except('_token'));
            $articulo->Estatus = $Estatus;
            $articulo->save();
        } else {
            $articulo = Articulo::find($id);
            $articulo->fill($request->except('_token'));
            $articulo->Estatus = $Estatus;
            $articulo->update();
        }
    }

    static function drop($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
    }
}
