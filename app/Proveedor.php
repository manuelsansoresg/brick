<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table      = 'proveedores';
    protected $primaryKey = 'Id';
    protected $fillable   = ['RFC', 'Nombre', 'Calle', 'NumeroExterior', 'NumeroInterior', 'Colonia', 'Ciudad', 'Estado', 'CodigoPostal', 'Telefono', 'Contacto', 'Email'];

    static function getAll()
    {
        $proveedor = Proveedor::all();
        return $proveedor;
    }
}
