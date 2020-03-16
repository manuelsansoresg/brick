<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Entrada extends Model
{
    protected $table = 'entradas';
    protected $primaryKey = 'Id';
    protected $fillable = ['IdMovimiento','IdProveedor','Fecha','Subtotal','Iva','Descuento','Importe','Estatus','Observaciones','IdUsuario',];

    public static function getAll()
    {
        $entradas = Entrada::select('entradas.Id', 'movimiento.Descripcion as movimiento', 'proveedores.Nombre as proveedor', 'entradas.Fecha','Subtotal', 'Iva', 'Descuento', 'Importe', 'Observaciones')
                            ->join('movimiento', 'movimiento.Id', '=', 'entradas.Id')
                            ->join('proveedores', 'proveedores.Id', '=', 'entradas.IdProveedor')
                            ->join('users', 'users.id', '=', 'entradas.IdUsuario')
                            ->get();
        return $entradas;
    }

    public static function saveEdit($IdProduccion)
    {

        $produccion             = Produccion::select('produccion.created_at', 'produccion.IdPedido', 'Subtotal', 'Iva', 'descuento', 'Importe')
                                    ->join('pedido', 'pedido.IdPedido', '=', 'produccion.IdPedido')
                                    ->where('Id',$IdProduccion)->first();

        $get_detalle_produccion = DetalleProducion::getByProduccion($IdProduccion);
        $total_diferencia       = 0;
        $id_diferencia          = 0;



        $find_entrada = Entrada::where('IdMovimiento', 1)->where('IdProveedor', $produccion->IdPedido)->count();


        if($find_entrada == 0){
            DB::beginTransaction();

            try {

                $data_entrada = array(
                    'IdMovimiento' => 1,
                    'IdProveedor' => $produccion->IdPedido,
                    'Fecha' => $produccion->created_at,
                    'Subtotal' => $produccion->Subtotal,
                    'Iva' => $produccion->Iva,
                    'Descuento' => $produccion->descuento,
                    'Importe' => $produccion->Importe,
                    'Estatus' => 1,
                    'Observaciones' => '',
                    'IdUsuario' => Auth::id(),
                );
                $entrada = new Entrada($data_entrada);
                $entrada->save();

               /* DB::insert('insert into entradas (IdMovimiento, IdProveedor, Fecha, Subtotal, Iva, Descuento, Importe, Estatus, Observaciones, IdUsuario)
                            values (?, ?,?,?,?,?,?,?,?,?)',
                    [1, $produccion->IdPedido, $produccion->created_at,  $produccion->Subtotal, $produccion->Iva, $produccion->descuento , $produccion->Importe, 1, '', Auth::id() ]
                );*/

                foreach ($get_detalle_produccion as $detalle_produccion) {

                    $produccion_actual  = producccion_actual($detalle_produccion->IdProducion, $detalle_produccion->IdProducto);
                    $total_actual       = total_actual($detalle_produccion->IdProducion, $detalle_produccion->IdProducto);
                    $diferencia         = $total_actual -$produccion_actual;

                    $data_detalle = array(
                        'IdEntrada' => $entrada->Id, 'IdProducto' => $detalle_produccion->IdProducto, 'Cantidad' => $produccion_actual,
                        'Precio' =>0, 'Descuento' =>$produccion->descuento, 'Importe' => $produccion->Importe,
                        'Observaciones' => ''
                    );

                    $detalle_entrada = new DetalleEntrada($data_detalle);
                    $detalle_entrada->save();

                    $total_diferencia  += $diferencia;

                }



                $get_articulo = Articulo::where('ClaveInterna', '999999')->first();
                $get_existencia = Existencia::where('IdProducto',$get_articulo->id)->first();

                $data_detalle = array(
                    'IdEntrada' => $entrada->Id, 'IdProducto' => $get_articulo->id, 'Cantidad' => $total_diferencia,
                    'Precio' => 0, 'Descuento' => $produccion->descuento, 'Importe' => $produccion->Importe,
                    'Observaciones' => ''
                );
                $detalle_entrada = new DetalleEntrada($data_detalle);
                $detalle_entrada->save();

                $existencia = Existencia::where('id', $get_existencia->id)->first();
                $existencia->existencia = $get_existencia->existencia + $total_diferencia;
                $existencia->update();



                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
        }


    }

}
