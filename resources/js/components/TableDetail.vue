<template>
    <div>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                <li class="breadcrumb-item"> <a href="/admin//produccion">PRODUCCIÓN </a> </li>
                                <li class="breadcrumb-item active">NUEVO</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-primary">
                                <div class="card-header">DATOS GENERALES</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-9">
                                            <small>Los campos marcados con * son obligatorios </small>
                                            <div class="w-100" id="pedido"></div>
                                            <label class="small">*CLIENTE</label>
                                            <input type="text" class="form-control" v-model="cliente.Nombre" readonly>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="small">FOLIO</label>
                                            <input class="form-control form-control-sm" type="text" :value="pedido.IdPedido" placeholder="FOLIO" readonly >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-9">
                                            <label class="small">DOMICILIO</label>
                                            <input type="text" class="form-control" readonly v-model="domicilio">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="small">FECHA</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" name="Fecha" :value="pedido.fecha" class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false" readonly>

                                            </div>
                                            <div class="w-100"></div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-9">
                                            <div class="form-group mb-2">
                                                <label class="small">SUPERVISOR</label>
                                                <select name="IdEmpleadoSupervisor" class="form-control form-control-sm">
                                                    <option value="" v-for="empleados in empleados"> {{ empleados.Nombre }} </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row ">
                                        <div class="col-12 col-md-12">
                                            <div class="col-12 text-right pb-4" style="padding-bottom:20px;">

                                            </div> <!-- /div-action -->

                                            <table id="tblpedido" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                                <thead>
                                                <tr>
                                                    <th>DESCRIPCIÓN</th>
                                                    <th>CANT</th>
                                                    <th>PRODUCCIÓN ACTUAL</th>
                                                    <th>DIFERENCIA</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody v-for="detalle_pedido in detalle_pedidos">
                                                <tr>
                                                    <td>{{ detalle_pedido.descripcion }}</td>
                                                    <td> {{ setInt(detalle_pedido.cantidad) }} </td>
                                                    <td> <span>{{detalle_pedido.produccion_actual }}</span>  </td>
                                                    <td> <span>{{ detalle_pedido.diferencia }}</span>  </td>
                                                    <td>
                                                        <a href="#" class="btn btn-success btn-sm"  v-if="detalle_pedido.estatus == 1" disabled >Detalle</a>
                                                        <a href="#" class="btn btn-success btn-sm"  v-else :disabled="isPrepare" @click="viewDetail(setInt(detalle_pedido.cantidad), detalle_pedido.id)">Detalle</a>
                                                        <a href="#" class="btn btn-primary btn-sm" v-if="detalle_pedido.estatus == 1" :disabled="isPrepare" @click="viewSecado(setInt(detalle_pedido.cantidad), detalle_pedido.id)">Avance secado</a>
                                                        <a href="#" class="btn btn-primary btn-sm" v-else disabled >Avance secado</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 text-right pb-4">
                                            <a href="#" class="btn btn-danger">Cancelar</a>
                                            <a href="#" class="btn btn-success">Aceptar</a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        </div>
        <!-- Modal detalle -->
        <div class="modal fade" id="detalleModal"  tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="" method="POST" id="form_products">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="detalleModalLabel">DETALLES DEL ARTÍCULO  </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="container">
                                <div class="row">
                                    <div class="col-12 text-right" v-if="total_detalle>0">
                                        <a href="#" @click="moreDetail()" class="btn btn-success btn-sm "><i class="fas fa-plus"></i></a>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        Total de articulos  <span class="text-success"> {{ cantidad_detalle}} </span> ( <span class="badge badge-info text-white" v-if="total_detalle != 0">{{ total_detalle}}</span>
                                        <span class="badge badge-warning text-white" v-if="total_detalle == 0">{{ total_detalle}}</span> )
                                        <p v-if="!isModalSave" class="text-danger"> Ha exedido el número de articulos a agregar </p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">

                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>FECHA</th>
                                                <th>NOMBRE OPERARIO</th>
                                                <th>CANTIDAD</th>
                                                <th>OBSERVACIONES</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(detalle, index) in contenido_detalle">
                                                <td v-if="detalle.fecha == ''">{{ my_date  }}</td>
                                                <td v-if="detalle.fecha!= '' ">{{ detalle.fecha | fmtruncate(10) }}</td>
                                                <td>
                                                    <select name="empleado[]" class="form-control" v-model="detalle.operario">
                                                        <option  v-for="empleado in empleados" :value="empleado.Id"> {{ empleado.Nombre}} </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input name="Cantidad[]"  @change="changeCantidad(index)" type="number" v-model="detalle.cantidad" min="0" :max="cantidad_detalle" class="form-control">
                                                </td>
                                                <td>
                                                    <textarea  name="observaciones[]" v-model="detalle.observaciones" id="" cols="30" rows="3" class="form-control"></textarea>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 text-center" v-if="isSpinner">
                                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-dismiss="modal">CANCELAR</button>
                            <button type="button" class="btn btn-primary" v-if="isModalSave" @click="saveDetail()" >ACEPTAR</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- /Modal detalle -->
        <!--avance secado-->
        <div class="modal fade" id="avances_secadoModal"  tabindex="-1" role="dialog" aria-labelledby="avances_secadoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="" method="POST" id="form_secado">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="avances_secadoModalLabel">AVANCES DEL SECADO  </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="container">

                                <div class="row">
                                    <div class="col-12 text-center">
                                        Total de articulos  <span class="text-success"> {{ cantidad_detalle}} </span>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">

                                        <table class="table table-responsive" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>FECHA</th>
                                                <th>NOMBRE OPERARIO</th>
                                                <th>CANTIDAD</th>
                                                <th>EXCELENTE</th>
                                                <th>MALOS</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(detalle, index) in contenido_detalle">
                                                <td v-if="detalle.fecha == ''">
                                                    {{ my_date  }}

                                                </td>
                                                <td v-if="detalle.fecha!= '' ">{{ detalle.fecha | fmtruncate(10) }}</td>
                                                <td>
                                                    <span>{{ detalle.operario }}</span>
                                                </td>
                                                <td>{{ detalle.cantidad  }}</td>

                                                <td>
                                                    <input type="hidden" name="producionavanceid[]"  v-model="detalle.id">
                                                    <input name="CantidadBueno[]"  @change="changeSecado(index)" type="number" v-model="detalle.cantidad_bueno" min="0" :max="cantidad_detalle" class="form-control">
                                                    <p v-if="detalle.restante == 0" class="text-danger"> Ha exedido el número de articulos a agregar </p>
                                                </td>
                                                <td>
                                                    <input name="CantidadMalo[]"  @change="changeSecado(index)" type="number" v-model="detalle.cantidadmalo" min="0" :max="cantidad_detalle" class="form-control">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 text-center" v-if="isSpinner">
                                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-dismiss="modal">CANCELAR</button>
                            <button type="button" class="btn btn-primary" v-if="isModalSave" @click="saveSecado()" >ACEPTAR</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!--avance secado-->
    </div>
</template>

<script>
    import { EventBus } from './event-bus.js';
    import Swal from 'sweetalert2'

    const axios = require('axios');

    export default {
        name  : "TableDetail",
        props : ['pedido_id', 'my_date'],
        data: function () {
            return{
                domicilio         : '',
                empleados         : [],
                cliente           : [],
                pedido            : [],
                detalle_pedidos   : [],
                produccion_actual : 0,
                diferencia        : 0,
                cantidad_detalle  : 0,
                total_detalle     : 0,
                contenido_detalle : [],
                contenido_secado  : [],
                isPrepare         : false,
                IdProducion       : 0,
                detallepedido_id  : 0,
                isModalSave       : true,
                isSpinner         : false

            }
        },


        created: function () {
            this.setProduction();



        },
        filters: {
            fmtruncate: function(value, length) {
                return value.substring(0,length);
            }
        },
        methods:{
            setInt : function(number){
                return parseInt(number)
            },

            changeCantidad : function(position){
                /*this.total_detalle = this.cantidad_detalle - val;*/
                var total = 0;
                $("input[name^='Cantidad']").each(function() {

                    if($(this).val() != ''){
                        total += parseInt($(this).val());
                    }
                });

                var resta = this.cantidad_detalle - total;

                if( resta<0 ){
                    this.isModalSave = false;
                    this.total_detalle = 0;
                }else{
                    this.isModalSave   = true;
                    this.total_detalle = this.cantidad_detalle - total;
                }


            },
            changeSecado : function(position){
                var total_bueno = parseInt(this.contenido_detalle[position].cantidad_bueno);
                var total_malo  = parseInt(this.contenido_detalle[position].cantidadmalo);
                var cantidad    = parseInt(this.contenido_detalle[position].cantidad);

                var resta_bueno = total_bueno - cantidad;
                var resta_malo  = total_malo - cantidad;

                var resta       = cantidad - total_bueno - total_malo;
                this.contenido_detalle[position].restante = 1;
                this.isModalSave = true;


                if( resta<0 ){
                   /*resta = 0;*/
                    this.contenido_detalle[position].restante = 0;
                    this.isModalSave = false;
                }

              /*  $('input[name^="CantidadBueno"]').each(function() {
                    total_bueno += parseInt($(this).val());
                });

                $('input[name^="CantidadMalo"]').each(function() {
                    total_malo += parseInt($(this).val());
                });
                total += total_bueno - total_malo;*/
                console.log('resta-'+ resta);
            },
            saveDetail : function(){

                let myForm    = document.getElementById('form_products');
                let formData  = new FormData(myForm);
                this.isSpinner = true;
                var vthis = this;

                axios.post('/admin/produccion/'+this.detallepedido_id+'/'+this.IdProducion+'/saveProduction', formData)
                    .then(function (response) {
                        var result  = response.data;
                        Swal.fire({
                            icon: 'success',
                            text: 'Artículo agregado',
                        });
                        vthis.isSpinner =false;
                        vthis.getTable(vthis.pedido_id, vthis.IdProducion);
                        $('#detalleModal').modal('hide');

                    })
                    .catch(e => {
                        this.isSpinner =false;
                    })
            },
            saveSecado: function(){
                let myForm    = document.getElementById('form_secado');
                let formData  = new FormData(myForm);
                this.isSpinner = true;
                var vthis = this;

                axios.post('/admin/produccion/'+this.detallepedido_id+'/'+this.IdProducion+'/saveSecado', formData)
                    .then(function (response) {
                        var result  = response.data;
                        Swal.fire({
                            icon: 'success',
                            text: 'Artículo agregado',
                        });
                        vthis.isSpinner =false;
                        vthis.getTable(vthis.pedido_id, vthis.IdProducion);
                        $('#avances_secadoModal').modal('hide');

                    })
                    .catch(e => {
                        this.isSpinner =false;
                    })
            },
            moreDetail : function(){
                this.contenido_detalle.push({fecha: '', 'operario': '', 'cantidad': 0, 'observaciones': ''});
                this.changeCantidad();
                this.isModalSave   = true;
            },
            viewDetail : function(max, detallepedido_id ){
                this.cantidad_detalle  = max;
                this.contenido_detalle = [];
                this.total_detalle     = max;
                this.detallepedido_id  = detallepedido_id;

                this.getTableDetail(detallepedido_id);


               /* $('#detalleModal').modal({
                    backdrop: false,
                    show: true
                });*/
                $('#detalleModal').modal('show');
            },
            viewSecado: function(max, detallepedido_id){
                this.cantidad_detalle  = max;
                this.contenido_detalle = [];
                this.total_detalle     = max;
                this.detallepedido_id  = detallepedido_id;

                this.getTableDetail(detallepedido_id);

                $('#avances_secadoModal').modal('show');

            },
            getTableDetail: function(detallepedido_id){ //saber si tiene productos agregados
                var vthis = this;
                axios.get
                ('/admin/produccion/'+detallepedido_id+'/'+vthis.IdProducion+'/getTableDetail')
                    .then(function (response) {
                        var result  = response.data;
                        var detalle = result.detalle;
                        let total   = result.total;

                        if(total == 0){

                            vthis.contenido_detalle.push({fecha: '', 'operario': '', 'cantidad': 0, 'observaciones': ''});
                        }else{
                            let total_cantidad = 0;
                            for (let i = 0; i < detalle.length; i++) {
                                total_cantidad += parseInt(detalle[i].Cantidad);
                                if(detalle[i].estatus == 1){
                                    vthis.contenido_detalle.push({id: detalle[i].id,  fecha: detalle[i].Fecha, 'operario':  detalle[i].Nombre, 'cantidad':  detalle[i].Cantidad, 'cantidad_bueno': detalle[i].CantidadBueno, 'cantidadmalo': detalle[i].CantidadMalo, 'restante': detalle[i].Cantidad });
                                }else{
                                    vthis.contenido_detalle.push({fecha: detalle[i].Fecha, 'operario':  detalle[i].IdEmpleado, 'cantidad': detalle[i].Cantidad, 'observaciones': detalle[i].observaciones});
                                }

                                /*$('#cantidad-'+i).val(detalle[i].Cantidad);*/

                            }

                            vthis.total_detalle = vthis.total_detalle - total_cantidad;

                        }


                    })

                    .catch(function (error) {

                    })
            },
            setProduction : function(){
                var vthis = this;
                axios.get
                ('/admin/produccion/'+vthis.pedido_id+'/setProduccion')
                    .then(function (response) {

                        var result        = response.data;
                        vthis.isPrepare   = true;
                        vthis.IdProducion = result.Id;
                        vthis.getTable(vthis.pedido_id,vthis.IdProducion);
                    })
                    .catch(function (error) {

                    })
            },

            getProduccionActual: function(pedido_id){
                var vthis = this;
                axios.get
                ('/admin/produccion/'+pedido_id+'/'+this.IdProducion+'/produccion_actual')
                    .then(function (response) {
                        var result  = response.data;
                        console.log(result);
                        return '<span>'+result+' </span>';
                    })
                    .catch(function (error) {
                        /*ins.isSpiner = false;
                        ins.btnBlock = true;*/
                        console.log(error);
                    })
            },

            getTable: function (pedidoId, id_produccion) {
                var vthis = this;
                axios.get
                ('/admin/produccion/'+pedidoId+'/'+id_produccion+'/getDetalle')
                    .then(function (response) {
                        var result              = response.data;
                        vthis.domicilio         = result.domicilio;
                        vthis.empleados         = result.empleados;
                        vthis.cliente           = result.cliente;
                        vthis.pedido            = result.pedido;
                        vthis.detalle_pedidos   = result.detalle_pedidos;
                    })
                    .catch(function (error) {
                        /*ins.isSpiner = false;
                        ins.btnBlock = true;*/
                        console.log(error);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
