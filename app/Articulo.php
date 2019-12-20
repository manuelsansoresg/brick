<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table      = 'articulo';
    protected $fillable   = ['ClaveInterna', 'descripcion', 'Nombre', 'Modelo', 'IdColor', 'IdFamilia', 'IdProveedor', 'IdUnidadCompra', 'IdUnidadVenta', 'stockmaximo', 'stockMinimo', 'Precio1', 'Precio2', 'Precio3', 'codigobarra', 'PrecioCosto', 'Observaciones', 'Idusuario', 'imagen', 'Estatus'];

    static function getById($id)
    {
        $articulo = Articulo::select('ClaveInterna', 'articulo.id', 'articulo.descripcion', 'familia.Descripcion as familia', 'proveedores.Nombre as proveedor', 'unidad.Abreviatura', 'codigobarra',
                                        'Precio1','Precio2','Precio3','PrecioCosto',
                                        'IdUnidadCompra', 'IdUnidadVenta','articulo.Observaciones', 'articulo.Estatus','imagen',
                                        'stockmaximo', 'stockMinimo'
                                )
                            ->join('familia', 'familia.Id', '=', 'articulo.IdFamilia')
                            ->join('proveedores', 'proveedores.Id', '=', 'articulo.IdProveedor')
                            ->join('unidad', 'unidad.Id', '=', 'articulo.IdUnidadCompra')
                            ->first();
        
        return $articulo;
    }

    static function getAll()
    {
        $articulo = Articulo::select('ClaveInterna','articulo.id', 'articulo.descripcion', 'familia.Descripcion as familia', 'proveedores.Nombre as proveedor', 'unidad.Abreviatura', 'Precio1', 'Precio2', 'Precio3')
                            ->join('familia', 'familia.Id', '=', 'articulo.IdFamilia')
                            ->join('proveedores', 'proveedores.Id', '=', 'articulo.IdProveedor')
                            ->join('unidad', 'unidad.Id', '=', 'articulo.IdUnidadCompra')
                            ->get();
        return $articulo;
    }

    static function getAllDatatable()
    {
        $articulos = self::getAll();
        $table     = array();

        foreach ($articulos as $articulo) {
                $precio_format = precio(max($articulo->Precio1, $articulo->Precio2, $articulo->Precio3));
                $precio = max($articulo->Precio1, $articulo->Precio2, $articulo->Precio3);

                $table[] = array(
                    $articulo->ClaveInterna,
                    $articulo->descripcion,
                    $articulo->familia,
                    $articulo->proveedor,
                    $articulo->Abreviatura,

                "<a onclick=\"agregarArticulo('$articulo->ClaveInterna', '$articulo->descripcion', '$articulo->Abreviatura', '$precio_format', '$precio')\" class=\"btn btn-primary\">
                    <i class=\"fas fa-plus-circle text-white\"></i>
                </a>"
                );
        }

        return array('data' => $table);
    }

    static function createUpdate($request, $path, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;


        if ($id == null) {
            
            $articulo = new Articulo($request->except('_token', 'imagen'));
            $articulo->Estatus = $Estatus;
           
        } else {
            
            $articulo = Articulo::find($id);
            $articulo->fill($request->except('_token', 'imagen'));
            $articulo->Estatus = $Estatus;
            
        }

        if ($request->hasFile('imagen') != false) {


            if ($id != null) {
                @unlink($path . '/' . $articulo->imagen);
                @unlink($path . '/thumb_' . $articulo->imagen);
            }
            
            $image_cover      = $request->file('imagen');
            $imagen           = uploadImage($_FILES['imagen'], $image_cover, $path, true);
            $articulo->imagen = $imagen;
        }

        if ($id == null) {
            $articulo->save();
        }else{
            $articulo->update();
        }

    }

    static function drop($id, $path)
    {
        $articulo = Articulo::find($id);
        @unlink($path.'/'.$articulo->imagen);
        @unlink($path. '/thumb_'.$articulo->imagen);
        $articulo->delete();
    }
}
