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
        $cliente = Cliente::where('Id', $id)->first();
        return $cliente;
    }

    static function getAll()
    {
        $cliente = Cliente::all();
        return $cliente;
    }

    static function createUpdate($request, $id = null)
    {
        if ($id == null) {
            $cliente = new Cliente($request->except('_token'));
            $cliente->save();
        } else {
            $cliente = Cliente::find($id);
            $cliente->fill($request->except('_token'));
            $cliente->update();
        }
    }

    static function drop($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
    }
}
