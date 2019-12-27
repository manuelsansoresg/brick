<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table      = 'empleado';
    protected $primaryKey = 'Id';
    protected $fillable   = ['Id', 'Nombre','FechaNacimiento', 'NSS', 'Email', 'puesto', 'departamento','Telefono1', 'Observaciones','Estatus',
                            'Pais','Estado','Ciudad','Calle','NoInt','NoExt','Cp','Telefono2','telefono3','Fax','Celular','IdPuesto','IdDepartamento',
                            'IdPeriodo','IdTurno'];

    static function getById($id)
    {
        $empleado = Empleado::select('empleado.Id', 'empleado.Nombre','empleado.FechaNacimiento','empleado.NSS','empleado.Email','departamento.Descripcion as departamento', 'puesto.Descripcion as puesto',
                                    'empleado.Pais','empleado.Estado','empleado.Ciudad','empleado.Calle','empleado.NoInt','empleado.NoExt','empleado.Cp',
                                    'empleado.Telefono1','empleado.Telefono2','empleado.telefono3','empleado.Fax','empleado.Celular','empleado.IdPuesto',
                                    'empleado.IdDepartamento','empleado.IdPeriodo','empleado.IdTurno','empleado.Estatus','empleado.Imagen','empleado.Observaciones'
                                )
                            ->join('puesto', 'puesto.Id', '=', 'empleado.IdPuesto')
                            ->join('departamento', 'departamento.Id', '=', 'empleado.IdDepartamento')                           
                            ->first();
        
        return $empleado;
    }

    static function getAll()
    {
        $empleado = Empleado::select('empleado.Id', 'empleado.Nombre','empleado.FechaNacimiento','empleado.NSS','empleado.Email','departamento.Descripcion as departamento', 'puesto.Descripcion as puesto',
                        'empleado.Pais','empleado.Estado','empleado.Ciudad','empleado.Calle','empleado.NoInt','empleado.NoExt','empleado.Cp',
                        'empleado.Telefono1','empleado.Telefono2','empleado.telefono3','empleado.Fax','empleado.Celular','empleado.IdPuesto',
                        'empleado.IdDepartamento','empleado.IdPeriodo','empleado.IdTurno','empleado.Estatus','empleado.Imagen','empleado.Observaciones')
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
