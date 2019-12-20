<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table      = 'empleado';
    protected $fillable   = ['id', 'Nombre', 'NSS', 'Email', 'puesto', 'departamento','Telefono', 'Observaciones','Estatus'];

    static function getById($id)
    {
        $empleado = Empleado::select('empleado.id', 'empleado.Nombre', 'departamento.Descripcion as departamento', 'puesto.Descripcion as puesto', 'Email',
                                        'FechaNacimiento','NSS','Pais','Estado','IdPeriodo','IdTurno',
                                        'Ciudad', 'Calle','NoInt','NoExt'. 'empleado.Estatus','empleado.Imagen',
                                        'Cp', 'Telefono1','Telefono2','Telefono3','Fax','Celular','empleado.Observaciones'
                                )
                            ->join('puesto', 'puesto.Id', '=', 'empleado.IdPuesto')
                            ->join('departamento', 'departamento.Id', '=', 'empleado.IdDepartamento')                           
                            ->first();
        
        return $empleado;
    }

    static function getAll()
    {
        $empleado = Empleado::select('empleado.id','empleado.Nombre','empleado.NSS','empleado.Email', 'departamento.id', 'departamento.Descripcion as departamento',
                    'puesto.Descripcion as puesto', 'empleado.Observaciones','empleado.Estatus','empleado.Telefono1 as Telefono')
                    ->join('puesto', 'puesto.Id', '=', 'empleado.IdPuesto')
                    ->join('departamento', 'departamento.Id', '=', 'empleado.IdDepartamento')  
                    ->get();
        return $empleado;
    }

    static function createUpdate($request, $path, $id = null)
    {
        $Estatus = isset($request->Estatus) ? 1 : 0;


        if ($id == null) {
            
            $empleado = new Empleado($request->except('_token', 'imagen'));
            $empleado->Estatus = $Estatus;
           
        } else {
            
            $empleado = Empleado::find($id);
            $empleado->fill($request->except('_token', 'imagen'));
            $empleado->Estatus = $Estatus;
            
        }

        if ($request->hasFile('imagen') != false) {


            if ($id != null) {
                @unlink($path . '/' . $empleado->imagen);
                @unlink($path . '/thumb_' . $empleado->imagen);
            }
            
            $image_cover      = $request->file('imagen');
            $imagen           = uploadImage($_FILES['imagen'], $image_cover, $path, true);
            $empleado->imagen = $imagen;
        }

        if ($id == null) {
            $empleado->save();
        }else{
            $empleado->update();
        }

    }

    static function drop($id, $path)
    {
        $empleado = Empleado::find($id);
        @unlink($path.'/'.$empleado->imagen);
        @unlink($path. '/thumb_'.$empleado->imagen);
        $empleado->delete();
    }
}
