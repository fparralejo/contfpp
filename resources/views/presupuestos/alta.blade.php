@extends('layout')
@extends('includes.calculos')

<?php
//decodifico los datos JSON
$clientes = json_decode($clientes);
$datos = json_decode($datos);

setlocale(LC_ALL, "es_ES");
$fechaHoy = strftime("%d/%m/%Y");

//dd($datos);
?>

@section('principal')
<h4><span>Presupuesto</span></h4>
<br/>

<script>
//hacer desaparecer en cartel
    $(document).ready(function () {
        setTimeout(function () {
            $("#accionTabla2").fadeOut(1500);
        }, 3000);
    });
</script>

@if (Session::has('errors'))
<div class="alert alert-success" id="accionTabla2" role="alert" style="display: block; ">
    <?php echo json_decode($errors); ?>
</div>
@endif




<style type="text/css">
    #productForm .inputGroupContainer .form-control-feedback,
    #productForm .selectContainer .form-control-feedback {
        top: 0;
        right: -15px;
    }
</style>

<form role="form" class="form-horizontal" id="presupuestoForm" name="presupuestoForm" 
      action="{{ URL::asset('presupuestos/create') }}" method="post" enctype="multipart/form-data">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-4">
            <div class="form-group">
                <img id="imagen" height="70" width="140" src="{{ URL::asset('images/').'/'.$datos->Logo }}" />
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-3">
        </div>
        <div class="col-md-5 col-lg-5 col-sm-5">
            <div class="form-group">
                <label class="col-md-6 control-label" for="identificacion">Presupuesto Nº:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="numPresupuesto" name="numPresupuesto"
                           maxlength="50" required="true" value="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-4">
            <div class="form-group">
                <label class="col-md-3 control-label">&nbsp;</label>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">&nbsp;</label>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">&nbsp;</label>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">&nbsp;</label>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">&nbsp;</label>
            </div>
            <div class="form-group">
                <input type="hidden" id="fechaPresup" value="" onchange="cambiarFecha(this.value);" class="hasDatepicker" />
                <script>
                    $("#fechaPresup").datepicker({
                        buttonImage: "{{ URL::asset('images/calendar.png') }}",
                        buttonImageOnly: true,
                        changeMonth: true,
                        changeYear: true,
                        showOn: 'button',
                        defaultDate: "2016/04/06",
                        autoSize: true
                    });

                </script>
                <label class="col-md-12">{{ $datos->municipio }}, {{ $fechaHoy }}  <img class="ui-datepicker-trigger" src="{{ URL::asset('images/calendar.png') }}" alt="..." title="..."></label>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-3">
        </div>
        <div class="col-md-5 col-lg-5 col-sm-5">
            <div class="form-group">
                <label class="col-md-3 control-label" for="identificacion">Cliente:</label>
                <div class="col-md-9">
                    <select class="form-control" id="TipoContador" name="TipoContador">
                        <option value="">Elige Cliente...</option>
                        @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->idCliente }}">{{ $cliente->nombre }} {{ $cliente->apellidos }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="identificacion">CIF:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="numPresupuesto" name="numPresupuesto"
                           maxlength="50" required="true" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="identificacion">Dirección:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="numPresupuesto" name="numPresupuesto"
                           maxlength="50" required="true" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="identificacion">Población:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="numPresupuesto" name="numPresupuesto"
                           maxlength="50" required="true" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="identificacion">Provincia:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="numPresupuesto" name="numPresupuesto"
                           maxlength="50" required="true" value="">
                </div>
            </div>
        </div>
    </div>
    
    <br/><br/><br/>

    <label>Conceptos</label>
    <hr style="border: 1px solid #0044cc;"/>

    <!--lineas de conceptos-->
    <div id="conceptos">
        <!--control de las lineas de conceptos-->
        <input type="hidden" id="numLinea" value="0">
        
        
<!--        <div class="col-md-12 col-lg-12 col-sm-12" id="">
            <div class="thumbnail row">
                <div class="caption">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="Cantidad">Cantidad</label>
                            <input type="text" class="form-control" id="Cantidad" name="Cantidad" maxlength="10" value="">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="Concepto">Concepto</label>
                            <input type="text" class="form-control" id="Concepto" name="Concepto" maxlength="10" value="">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="Precio">Precio</label>
                            <input type="text" class="form-control" id="Precio" name="Precio" maxlength="10" value="">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="Importe">Importe</label>
                            <input type="text" class="form-control" id="Importe" name="Importe" maxlength="10" value="">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="IVA">IVA</label>
                            <input type="text" class="form-control" id="IVA" name="IVA" maxlength="10" value="">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="Cuota">Cuota</label>
                            <input type="text" class="form-control" id="Cuota" name="Cuota" readonly value="">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="Total">Total</label>
                            <input type="text" class="form-control" id="Total" name="Total" readonly value="">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group" style="float: right;">
                            <button type="button" onclick="borrarLinea();" class="btn btn-xs btn-danger">Borrar</button>
                            <input type="hidden" name="linea" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        
        
    </div>


    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="form-group">
            <input type="button" id="" class="btn btn-xs btn-default" value="Añadir Concepto" onclick="addConcepto($('#numLinea').val());">
        </div>
    </div>
    
    <br/>
    
    <hr style="border: 1px solid #0044cc;"/>

    <script>
        function addConcepto(linea) {
            $('#numLinea').val(parseInt($('#numLinea').val())+1);
            
            var txtLinea='<div class="col-md-12 col-lg-12 col-sm-12" id="linea'+linea+'">'+
                                '<div class="thumbnail row">'+
                                    '<div class="caption">'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="Cantidad'+linea+'">Cantidad</label>'+
                                                '<input type="text" class="form-control" id="Cantidad'+linea+'" name="Cantidad'+linea+'" maxlength="20" '+
                                                        'onkeypress="return solonumeros(event);" style="text-align:right;" value="" onblur="calculoCantidad('+linea+');">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-5">'+
                                            '<div class="form-group">'+
                                                '<label for="Concepto'+linea+'">Concepto</label>'+
                                                '<input type="text" class="form-control" id="Concepto'+linea+'" name="Concepto'+linea+'" value="">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="Precio'+linea+'">Precio</label>'+
                                                '<input type="text" class="form-control" id="Precio'+linea+'" name="Precio'+linea+'" maxlength="20" value=""'+
                                                        'onkeypress="return solonumerosNeg(event);" style="text-align:right;" value="" onblur="calculoPrecio('+linea+');">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="Importe'+linea+'">Importe</label>'+
                                                '<input type="text" class="form-control" id="Importe'+linea+'" name="Importe'+linea+'" maxlength="20" value=""'+
                                                        'onkeypress="return solonumerosNeg(event);"style="text-align:right;" value="" onblur="calculoImporte('+linea+');">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="IVA'+linea+'">IVA</label>'+
                                                '<input type="text" class="form-control" id="IVA'+linea+'" name="IVA'+linea+'" maxlength="20" value="21"'+
                                                        'onkeypress="return solonumeros(event);"style="text-align:right;" value="" onblur="calculoIVA('+linea+');">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="Cuota'+linea+'">Cuota</label>'+
                                                '<input type="text" class="form-control" id="Cuota'+linea+'" name="Cuota'+linea+'" readonly value="">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="Total'+linea+'">Total</label>'+
                                                '<input type="text" class="form-control" id="Total'+linea+'" name="Total'+linea+'" readonly value="">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group" style="float: right;">'+
                                                '<button type="button" onclick="borrarLinea('+linea+');" class="btn btn-xs btn-danger">Borrar</button>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
            
            var div = $(txtLinea);
            $("#conceptos").append(div);
            
        }
        
        function borrarLinea(linea){
            $("#linea"+linea).remove();
        }
    </script>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>

    <!--<input type="hidden" id="idCliente" name="idCliente" value="" />-->
    <input type="button" id="submitir" class="btn btn-default" value="Guardar" onclick="submitDatos();" >
</form>

<script>
    function submitDatos() {
        ok = "SI";
        if ($('#errorFile').val() === "ERROR") {
            ok = "NO";
        }

        if (ok === 'SI') {
            //document.datosForm.submit();
            //$('#datosForm').submit();
        } else {
            alert('El fichero del Logo ya existe, eliga otro fichero');
        }
    }

    $(document).ready(function () {
        $('#datosForm').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                Nombre: {
                    validators: {
                        notEmpty: {
                            message: 'El Nick es obligatorio'
                        }
                    }
                },
                Password: {
                    validators: {
                        notEmpty: {
                            message: 'El Password es obligatorio'
                        }
                    }
                },
                identificacion: {
                    validators: {
                        notEmpty: {
                            message: 'El Nombre de Empresa es obligatorio'
                        }
                    }
                },
                email1: {
                    validators: {
                        notEmpty: {
                            message: 'El Email 1 es obligatorio'
                        }
                    }
                }
            }


        });
    });
</script>



@stop



