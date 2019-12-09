<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table      = 'clientes';
    protected $primaryKey = 'Id';
    protected $fillable   = ['RFC', 'Nombre', 'Calle', 'NumeroExterior', 'NumeroInterior', 'Colonia', 'Ciudad', 'Estado', 'CodigoPostal', 'Telefono', 'Contacto', 'Email', 'Referencia', 'Municipio', 'Pais'];

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
       

        if ($id == null) {
            $familia = new Familia($request->except('_token'));
            $familia->save();
        } else {
            $familia = Familia::find($id);
            $familia->fill($request->except('_token'));
            $familia->update();
        }
    }

    static function drop($id)
    {
        $familia = Familia::find($id);
        $familia->delete();
    }
}
