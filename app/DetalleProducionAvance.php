<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetalleProducionAvance extends Model
{
    protected $table= 'detalleproducionavance';
    protected $fillable = ['IdProducto', 'IdProducion', 'Fecha', 'IdEmpleado', 'Cantidad', 'observaciones', 'CantidadBueno', 'CantidadMalo', 'status'];


    public static function getByProduccion($IdProducto, $IdProducion)
    {
        $produccion = DetalleProducionAvance::where(array('IdProducto' => $IdProducto, 'IdProducion' => $IdProducion));
        return $produccion;
    }


    public static function getById($IdProducion, $IdProducto)
    {
        DB::enableQueryLog();
        $detalle = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)
                                            ->join('empleado', 'empleado.Id', '=' , 'IdEmpleado')
                                            ->get();

        return $detalle;
    }

    public static function getTotalDetalle($detalle_produccion_avance, $detalle_produccion)
    {
        $total = 0;
        $total1 = 0;
        $total2 = 0;
        $maximo = (int)$detalle_produccion->Cantidad;

        foreach ($detalle_produccion_avance as $detalle_produccion_avance){
            $bueno = (int)$detalle_produccion_avance->CantidadBueno;
            $malo = (int)$detalle_produccion_avance->CantidadMalo;
            $cant = (int)$detalle_produccion_avance->Cantidad;

            $total = $total + $bueno;
            $total1 = $total1 + $malo;
            $total2 = $total2 + $cant;
        }

        if ($total == 0){
            if ($total1 == 0){
                if ($maximo < $total2)
                {
                    return $maximo - $total2;    
                }elseif($maximo == $total2){
                    return $total2;
                }
                
            }else{
                return $maximo - $total1;
            }
        }else{
            return $maximo - $total;        }

        
    }

    static function createUpdate($request, $IdProducion, $IdProducto, $detalle_produccion, $id = null)
    {
        if ($id == null) { 
            
            $detalle = new DetalleProducionAvance($request->except('_token'));
            $detalle->IdProducto = $IdProducto;
            $detalle->IdProducion = $IdProducion;           
            $detalle->save();

            $detalleAvance = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->get();
            $total2 = 0;

            foreach ($detalleAvance as $detalles){
                $cant = (int)$detalles->Cantidad;
                $total2 = $total2 + $cant;
            }
                      
            $cantidad = $total2;            
            $cantidad_produccion = $detalle_produccion->Cantidad;
            
            // ACTUALIZAR LOS ESTATUS DEPENDIENDO DE LA VALIDADCION.
            if ($cantidad == $cantidad_produccion){
                $oExecutar = DetalleProducion::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->update(['clasificacion' => 'a']);
            }                      
        }
       
        return $detalle;
    }
    static function CreateUpdateAvance($request, $IdProducion, $IdProducto, $detalle_produccion,$id = null){
        if ($id == null) 
        {
            $addmore = $request->addmore;  
            //dd($addmore);
            foreach($addmore as $add)
            {               
                $oExecutar = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->where('IdEmpleado',$add['IdEmpleado'])->update(['CantidadBueno' => $add['CantidadBueno'],'CantidadMalo'=> $add['CantidadBueno']]);                                
            }

         /*   $detalle = new DetalleProducionAvance($request->except('_token'));
            $detalle->IdProducto = $IdProducto;
            $detalle->IdProducion = $IdProducion;           
            dd($detalle);
            //$detalle->update();

            
            // obtengo los valores iniciales
            $detalleAvance = DetalleProducionAvance::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->get();
            $total2 = 0;

            foreach ($detalleAvance as $detalles){
                $cant = (int)$detalles->Cantidad;
                $total2 = $total2 + $cant;
            }
                      
            $cantidad = $total2;
            $cantidad_produccion = $detalle_produccion->Cantidad;           
                      

            if ($cantidad_produccion > $cantidad)
            {
                //Actualizo la primera columna para que no escriba habilitando el primer campo
                $detalle->IdProducto = $IdProducto;
                $detalle->IdProducion = $IdProducion;  
                $detalle->status = 1;         
                $detalle->update();

                //actualizo el estatus de detalle produccion                
                $oExecutar = DetalleProducion::where('IdProducion', $IdProducion)->where('IdProducto', $IdProducto)->update(['clasificacion' => 'd']);                               
            }*/
            
        }

        return 0;
    }

}
