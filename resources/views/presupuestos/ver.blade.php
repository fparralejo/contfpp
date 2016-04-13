@extends('layout')

<?php
//decodifico los datos JSON
$clientes = json_decode($clientes);
$datos = json_decode($datos);
$presupuesto = json_decode($presupuesto);
$presupuestoDetalle = json_decode($presupuestoDetalle);
$numero = json_decode($numero);

//var_dump($presupuestoDetalle);die;

//averiguo si estamos editando o es nuevo
if($presupuesto === ''){//nuevo
    setlocale(LC_ALL, "es_ES");
    $fechaHoy = strftime("%d/%m/%Y");
    $fechaVtoPresupuesto = strftime("%d/%m/%Y");
    $idPresupuesto = '';
}else{//editar
    $fechaHoy = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$presupuesto->FechaPresupuesto)->format('d/m/Y');
    $fechaVtoPresupuesto = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$presupuesto->FechaVtoPresupuesto)->format('d/m/Y');
    $idPresupuesto = $presupuesto->IdPresupuesto;
}



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
      action="{{ URL::asset('presupuestos/createEdit') }}" method="post">
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
                    <input type="text" class="form-control" id="numPresupuesto" name="numPresupuesto" style="text-align:right;"
                           maxlength="50" required="true" value="{{ $numero }}" onblur="">
                    <input type="hidden" id="IdPresupuesto" name="IdPresupuesto" value="{{ $idPresupuesto }}">
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
                <label class="col-md-12">{{ $datos->municipio }},&nbsp;&nbsp; 
                    <input type="text" id="fechaPresup" name="fechaPresup" value="{{ $fechaHoy }}" size="7" style="border-color: #FFF;border-width:0;" />
                </label>
                <script language="JavaScript">
//                    NO FUNCIONA
//                    jQuery(function($){
//                       $.datepicker.regional['es'] = {
//                          closeText: 'Cerrar',
//                          prevText: '&#x3c;Ant',
//                          nextText: 'Sig&#x3e;',
//                          currentText: 'Hoy',
//                          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
//                          monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
//                          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
//                          dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
//                          dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
//                          weekHeader: 'Sm',
//                          firstDay: 1,
//                          isRTL: false,
//                          showMonthAfterYear: false,
//                          yearSuffix: ''};
//                       $.datepicker.setDefaults($.datepicker.regional['es']);
//                    });

                    $("#fechaPresup").datepicker({
                        format: 'dd/mm/yyyy',
                        changeMonth: true,
                        changeYear: true
                    });
                </script>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-3">
        </div>
        <div class="col-md-5 col-lg-5 col-sm-5">
            <div class="form-group">
                <label class="col-md-3 control-label" for="idCliente">Cliente:</label>
                <div class="col-md-9">
                    <select class="form-control" id="idCliente" name="idCliente" onchange="cargaCliente(this.value);">
                        <option value="">Elige Cliente...</option>
                        <option value="Nuevo">Nuevo...</option>
                        @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->idCliente }}">{{ $cliente->nombre }} {{ $cliente->apellidos }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="CIF">CIF:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="CIF" name="CIF"
                           readonly required="true" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="Dirección">Dirección:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="Dirección" name="Dirección"
                           readonly required="true" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="Poblacion">Población:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="Poblacion" name="Poblacion"
                           readonly required="true" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="Provincia">Provincia:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="Provincia" name="Provincia"
                           readonly required="true" value="">
                </div>
            </div>
        </div>
    </div>
    
    <br/><br/><br/>
    
    @include('includes.calculos')

    <label>Conceptos</label>
    <hr style="border: 1px solid #0044cc;"/>

    <!--lineas de conceptos-->
    <div id="conceptos">
        <!--control de las lineas de conceptos-->
        <input type="hidden" id="numLinea" name="numLinea" value="0">
        <input type="hidden" id="esValido" name="esValido" value="false"/>     
        
        
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
                                                        'onkeypress="return solonumeros(event);" style="text-align:right;" value=""'+
                                                        'onblur="calculoCantidad('+linea+');sumas();formatear(this);">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-5">'+
                                            '<div class="form-group">'+
                                                '<label for="Concepto'+linea+'">Concepto</label>'+
                                                '<textarea class="form-control" id="Concepto'+linea+'" name="Concepto'+linea+'" rows="0"></textarea>'+
                                                '<input type="hidden" id="IdArticulo'+linea+'" name="IdArticulo'+linea+'" value=""/>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="Precio'+linea+'">Precio</label>'+
                                                '<input type="text" class="form-control" id="Precio'+linea+'" name="Precio'+linea+'" maxlength="20" value=""'+
                                                        'onkeypress="return solonumerosNeg(event);" style="text-align:right;" value=""'+
                                                        'onblur="calculoPrecio('+linea+');sumas();formatear(this);">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="Importe'+linea+'">Importe</label>'+
                                                '<input type="text" class="form-control" id="Importe'+linea+'" name="Importe'+linea+'" maxlength="20" value=""'+
                                                        'onkeypress="return solonumerosNeg(event);" style="text-align:right;" value=""'+
                                                        'onblur="calculoImporte('+linea+');sumas();formatear(this);">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="IVA'+linea+'">IVA</label>'+
                                                '<input type="text" class="form-control" id="IVA'+linea+'" name="IVA'+linea+'" maxlength="20" value="21"'+
                                                        'onkeypress="return solonumeros(event);" style="text-align:right;" value=""'+
                                                        'onblur="calculoIVA('+linea+');sumas();formatear(this);">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="Cuota'+linea+'">Cuota</label>'+
                                                '<input type="text" class="form-control" id="Cuota'+linea+'" name="Cuota'+linea+'" style="text-align:right;" readonly value="">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group">'+
                                                '<label for="Total'+linea+'">Total</label>'+
                                                '<input type="text" class="form-control" id="Total'+linea+'" name="Total'+linea+'" style="text-align:right;" readonly value="">'+
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
            $("#Concepto"+linea).autoResize();
        }
        
        function borrarLinea(linea){
            $("#linea"+linea).remove();
            sumas();
        }
        
        function formatear(objeto){
            objeto.value = parseFloat(objeto.value).toFixed(2);
        }
        

        //veo si vienen datos de editar ($presupuesto y $presupuestoDetalle
        $(document).ready(function() {
            <?php
            if(isset($presupuestoDetalle) && is_array($presupuestoDetalle)){
                ?>
                //cargo el cliente
                $('#idCliente').val(<?php echo $presupuesto->IdCliente; ?>);
                cargaCliente(<?php echo $presupuesto->IdCliente; ?>);
                
                //factura proforma
                $('#FormaPago').val('<?php echo $presupuesto->FormaPago; ?>');
                //forma de pago
                $('#Proforma').val('<?php echo $presupuesto->Proforma; ?>');
                
                <?php
                //ahora cargo el presupuestoDetalle
                for ($i = 0; $i < count($presupuestoDetalle); $i++) {
                ?>
                var lineaAux = $('#numLinea').val();
                //añado linea
                addConcepto(lineaAux);//esta funcion ya aumenta el contador "numLinea"
                //ahora relleno los datos de esta linea
                $('#Cantidad'+lineaAux).val(parseFloat(<?php echo $presupuestoDetalle[$i]->Cantidad; ?>).toFixed(2));
                $('#Concepto'+lineaAux).val('<?php echo $presupuestoDetalle[$i]->DescripcionProducto; ?>');
                $('#IdArticulo'+lineaAux).val('<?php echo $presupuestoDetalle[$i]->IdArticulo; ?>');
                $('#Precio'+lineaAux).val(parseFloat(<?php echo $presupuestoDetalle[$i]->ImporteUnidad; ?>).toFixed(2));
                $('#Importe'+lineaAux).val(parseFloat(<?php echo $presupuestoDetalle[$i]->Importe; ?>).toFixed(2));
                $('#IVA'+lineaAux).val(parseFloat(<?php echo $presupuestoDetalle[$i]->TipoIVA; ?>).toFixed(2));
                $('#Cuota'+lineaAux).val(parseFloat(<?php echo $presupuestoDetalle[$i]->CuotaIva; ?>).toFixed(2));
                $('#Total'+lineaAux).val(parseFloat(<?php echo ((float)$presupuestoDetalle[$i]->Importe + (float)$presupuestoDetalle[$i]->CuotaIva); ?>).toFixed(2));
                //actualizo las sumas
                sumas();
                //aumento el contador
                //$('#numLinea').val(parseInt($('#numLinea').val())+1);

                <?php
                }
            }
            ?>
        
        
        });
        
        
        
        
    </script>

    
    <!--totales del presupuesto-->
    <div class="col-md-12 col-lg-12 col-sm-12" id="">
        <hr style="border: 1px solid #0044cc;"/>
        
        <div class="thumbnail row">
            <div class="caption">
                <div class="col-md-7">
                    <label for="totalImporte">Sumas</label>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="totalImporte">Importe</label>
                        <input type="text" class="form-control" style="text-align:right;" id="totalImporte" name="totalImporte" readonly value="">
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="Cuota">Cuota</label>
                        <input type="text" class="form-control" style="text-align:right;" id="totalCuota" name="totalCuota" readonly value="">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="Total">Total</label>
                        <input type="text" class="form-control" style="text-align:right;" id="Total" name="Total" readonly value="">
                    </div>
                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>
    
        <hr style="border: 1px solid #0044cc;"/>
    
        <div class="thumbnail row">
            <div class="caption">
                <div class="col-md-1">
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="FormaPago">Forma de Pago:</label>
                        <select class="form-control" id="FormaPago" name="FormaPago">
                            <option value=""></option>
                            <option value="Contado">Contado</option>
                            <option value="Pagare">Pagaré</option>
                            <option value="Recibo">Recibo</option>
                            <option value="Talon">Talón</option>
                            <option value="Transferencia">Transferencia</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Proforma">Factura Proforma:</label>
                        <select class="form-control" id="Proforma" name="Proforma">
                            <option value="NO">NO</option>
                            <option value="SI">SI</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="validez">Fecha Validez</label>
                        <input type="text" class="form-control" id="FechaVtoPresupuesto" name="FechaVtoPresupuesto" style="text-align:right;" 
                               value="{{ $fechaVtoPresupuesto }}">
                        <script>
                        $("#FechaVtoPresupuesto").datepicker({
                            format: 'dd/mm/yyyy',
                            changeMonth: true,
                            changeYear: true
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="caption">
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-1">
                </div>
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <input type="button" id="submitir" class="btn btn-default" value="Guardar" onclick="submitDatos();" >
                    </div>
                </div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">
                </div>
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <input type="button" id="" class="btn btn-default" value="Ver PDF" onclick="" >
                    </div>
                </div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">
                </div>
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <input type="button" id="" class="btn btn-success" value="Enviar" onclick="" >
                    </div>
                </div>
                
            </div>
        </div>
        
        
        <!--<input type="hidden" id="idCliente" name="idCliente" value="" />-->
    </div>

</form>

<script>
    function cargaCliente(IdCliente){
        if(IdCliente === 'Nuevo'){
            location.href = "{{ URL::asset('clientes') }}";
        }else{
            $.ajax({
                data:{"idCliente":IdCliente},  
                url: "{{ URL::asset('cliente/show') }}",
                type:"get",
                success: function(data) {
                    var cliente = JSON.parse(data);
                    $('#CIF').val(cliente.CIF);
                    $('#Direccion').val(cliente.direccion);
                    $('#Poblacion').val(cliente.municipio);
                    $('#Provincia').val(cliente.provincia);
                    //$('#FormaPago').val(cliente.forma_pago_habitual);
                }
            });
        }
    }

    function submitDatos(){
        var esValido = $('#esValido');
        esValido.value = "true";
        textoError='';

        //revisamos toda la tabla de lineas de presupuesto, hay que revisar cantidad, precio, concepto
        // importe que se cumpla importe = cantidad x precio
        var cantidades = new Array();
        var precios = new Array();
        var importes = new Array();
        var conceptos = new Array();
//        $(document).ready(function(){
            $('#presupuestoForm').find(":input").each(function(){
                var elemento = this;
                //comprobamos el nombre del elemento y lo guardamos en ua array segun sea cantidad, precio, importe y concepto
                var nombreElemento = elemento.name;
                if(nombreElemento.substring(0,8) === 'Cantidad'){//es un elemento cantidad
                    cantidades[nombreElemento.substr(8,3)] = elemento.value;
                }else 
                if(nombreElemento.substring(0,6) === 'Precio'){//es un elemento precio
                    precios[nombreElemento.substr(6,3)] = elemento.value;
                }else
                if(nombreElemento.substring(0,7) === 'Importe'){//es un elemento importe
                    importes[nombreElemento.substr(7,3)] = elemento.value;
                }else            
                if(nombreElemento.substring(0,8) === 'Concepto'){//es un elemento concepto
                    conceptos[nombreElemento.substr(8,3)] = elemento.value;
                }else
                //compruebo si IdArticulo esta NULL o vacio
                if(nombreElemento.substring(0,10)==='IdArticulo'){//es un elemento IdArticulo
                    if(elemento.value === '' || elemento.value === 'null'){
                        //es una vble. hidden del formulario
                        //guardarArticulosNuevos.value = 'SI';
                    }
                }
            });
//        });
        //compruebo que los arrays lleven datos (lentgh)
        //si fuese 0 es que no se a introducido ninguna linea de factura y eso es incongruente
        if(cantidades.length === 0){
            textoError = textoError + "Debe introducidir alguna linea en el presupuesto.\n";
            esValido.value = 'false';
        }


        var falloComp = 'NO';
        var falloImporte0 = 'NO';
        var falloConceptoVacio = 'NO';

        for(i=0;i<cantidades.length;i++){
            //comprobamos que este control existe
            if(typeof cantidades[i] !== 'undefined' && cantidades[i] !== 'null'){
                if(isNaN(parseFloat(precios[i])) || isNaN(parseFloat(cantidades[i]))){
                }else{
                    //importe no sea 0
                    var importeNumero = parseFloat(importes[i]);
                    if(importeNumero === 0){
                        var importe = 'Importe' + i;
                        //document.getElementById(importe).style.borderColor='#FF0000';
                        esValido.value = 'false';
                        falloImporte0 = 'SI';
                    }

                    //importe no este vacio
                    if(conceptos[i] === ''){
                        var concepto = 'Concepto' + i;
                        //document.getElementById(concepto).style.borderColor='#FF0000';
                        esValido.value = 'false';
                        falloConceptoVacio = 'SI';
                    }

                    //compruebo que importe= cantidad x precio en esta linea
                    if(cantidades[i] === 0 || precios[i] === 0 || cantidades[i] === '0.00' || precios[i] === '0.00' ||
                       cantidades[i] === '' || precios[i] === ''){
                        //nada
                    }else{
                        var importeComp = parseFloat(cantidades[i]) * parseFloat(precios[i]);
                        importeComp = parseFloat(importeComp).toFixed(2);
                        if(importeComp !== parseFloat(importeNumero).toFixed(2)){
                            //var cantidad = 'Cantidad'+i;
                            //document.getElementById(cantidad).style.borderColor='#FF0000';
                            //var precio='precio'+i;
                            //document.getElementById(precio).style.borderColor='#FF0000';
                            //var importe='importe'+i;
                            //document.getElementById(importe).style.borderColor='#FF0000';
                            esValido.value = 'false';
                            falloComp = 'SI';
                        }
                    }
                }
            }
        }

        //compruebo si esValido.value viene en false, si es asi indico el error
        if(esValido.value === 'false'){
            if(falloComp === 'SI'){
                textoError = textoError + "Los datos introducidos no son correctos, hay una incongruencia en cantidad, precio e importe.\n";
            }
            if(falloImporte0 === 'SI'){
                textoError = textoError + "El importe debe ser un valor positivo.\n";
            }
            if(falloConceptoVacio === 'SI'){
                textoError = textoError + "Debe haber algún dato en el concepto.\n";
            }
        }

        //comprobacion del Cliente
        if ($('#idCliente').val() === ''){ 
          textoError = textoError + "Es necesario introducir un cliente.\n";
      //    document.form1.Contacto.style.borderColor='#FF0000';
          //document.form1.Contacto.title ='Se debe introducir un cliente';
          esValido.value = false;
        }
        
        
        //comprobacion del campo 'numPresupuesto'
        if ($('#numPresupuesto').val() === ''){ 
          textoError = textoError + "Es necesario introducir un número del presupuesto.\n";
          //document.form1.numPresupuesto.style.borderColor='#FF0000';
          //document.form1.numPresupuesto.title ='Se debe introducir un número de factura';
          esValido.value = "false";
        }


        //indicar el mensaje de error si es 'esValido.value'='false'
        if (esValido.value === 'false'){
            if(textoError === ''){
                textoError = 'Revise los datos. NO estan correctos';
            }
            alert(textoError);
        }

        if(esValido.value === 'true'){
//            if(guardarArticulosNuevos.value === 'SI'){
//              if (confirm("Ha incluido usted articulos nuevos, ¿desea añadirlos a la base de datos? (Aceptar = SI, Cancelar = NO)"))
//              {
//                  document.form1.guardarArticulosNuevos.value='SI';
//              }
//              else
//              {
//                  document.form1.guardarArticulosNuevos.value='NO';
//              }
//            }
            $("#submitir").val("Enviando...");
            document.getElementById("submitir").disabled = true;
            document.presupuestoForm.submit();
        }else{
            return false;
        }  
    }

    
//    $(document).ready(function () {
//        $('#datosForm').formValidation({
//            framework: 'bootstrap',
//            icon: {
//                valid: 'glyphicon glyphicon-ok',
//                invalid: 'glyphicon glyphicon-remove',
//                validating: 'glyphicon glyphicon-refresh'
//            },
//            fields: {
//                Nombre: {
//                    validators: {
//                        notEmpty: {
//                            message: 'El Nick es obligatorio'
//                        }
//                    }
//                },
//                Password: {
//                    validators: {
//                        notEmpty: {
//                            message: 'El Password es obligatorio'
//                        }
//                    }
//                },
//                identificacion: {
//                    validators: {
//                        notEmpty: {
//                            message: 'El Nombre de Empresa es obligatorio'
//                        }
//                    }
//                },
//                email1: {
//                    validators: {
//                        notEmpty: {
//                            message: 'El Email 1 es obligatorio'
//                        }
//                    }
//                }
//            }
//
//
//        });
//    });
</script>



@stop



