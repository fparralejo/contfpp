@extends('layout')

<?php
//decodifico los datos JSON
$clientes = json_decode($clientes);
$datos = json_decode($datos);
$presupuesto = json_decode($presupuesto);
$presupuestoDetalle = (array)json_decode($presupuestoDetalle);
$numero = json_decode($numero);
$editarCampoNumero = json_decode($editarCampoNumero);

//dd($presupuestoDetalle);die;

$fechaHoy = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$presupuesto->FechaPresupuesto)->format('d/m/Y');
$fechaVtoPresupuesto = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$presupuesto->FechaVtoPresupuesto)->format('d/m/Y');
$FechaProximaFacturaPeriodica = date('d/m/Y');
$idPresupuesto = $presupuesto->IdPresupuesto;
$FrecuenciaPeriodica = 1;



//dd($datos);
?>

@section('principal')
<h4><span>Datos Presupuestos para preparar Pedido</span></h4>
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
      action="{{ URL::asset('presupuestos/prepararPedido') }}" method="post">
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
            <div class="form-group" id="groupNumPresupuesto">
                <label class="col-md-6 control-label" for="identificacion">Presupuesto Nº:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="numPresupuesto" name="numPresupuesto" style="text-align:right;"
                           maxlength="50" required="true" value="{{ $numero }}" onkeypress="limpiar('groupNumPresupuesto','txtValidarNumPresupuesto');" 
                           onblur="validar(this,'groupNumPresupuesto','txtValidarNumPresupuesto');" <?php if($editarCampoNumero[0]->editar === 'NO'){echo 'readonly';} ?> >
                    <input type="hidden" id="IdPresupuesto" name="IdPresupuesto" value="{{ $idPresupuesto }}">
                </div>
                <div class="alert alert-dander" role="alert" style="display: none; text-align: right;" id="txtValidarNumPresupuesto">
                    <small class="help-block text-danger">Debes introducir un número</small>
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
                    <input type="text" id="fechaPresup" name="fechaPresup" value="{{ $fechaHoy }}" onchange="DesactivaImprimir();" size="7" style="border-color: #FFF;border-width:0;" />
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
            <div class="form-group" id="groupIdCliente">
                <label class="col-md-3 control-label" for="idCliente">Cliente:</label>
                <div class="col-md-9">
                @foreach ($clientes as $cliente)
                    @if($cliente->idCliente === $presupuesto->IdPresupuesto)
                        <input type="text" class="form-control" id="Cliente" name="Cliente"
                               readonly required="true" value="{{ $cliente->nombre }} {{ $cliente->apellidos }}">
                    @endif
                @endforeach
                    <input type="hidden"id="idCliente" name="idCliente" value="">
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
                    <input type="text" class="form-control" id="Direccion" name="Direccion"
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

    <label>Conceptos (Selecciona las líneas de los conceptos que vayan al pedido)</label>
    <hr style="border: 1px solid #0044cc;"/>

    <!--lineas de conceptos-->
    <div id="conceptos">
        <!--control de las lineas de conceptos-->
        <input type="hidden" id="numLinea" name="numLinea" value="0">
        <input type="hidden" id="esValido" name="esValido" value="false"/>     
        
        
    </div>


    <div class="col-md-12 col-lg-12 col-sm-12" id="groupAddConcepto">
<!--        <div class="form-group">
            <input type="button" id="" class="btn btn-xs btn-default" value="Añadir Concepto" onclick="addConcepto($('#numLinea').val());">
        </div>
        <div class="alert alert-dander" role="alert" style="display: none;" id="txtAddConcepto">
            <small class="help-block text-danger">Debe introducidir alguna línea en el presupuesto</small>
        </div>-->
    </div>
    
    <br/>
    

    <script>
        function addConcepto(linea) {
            //quito el texto de validaciones de líneas de conceptos 8si huebiese dado el error anteriormente)
            $('#txtAddConcepto').css({"display": "none"});
            
            $('#numLinea').val(parseInt($('#numLinea').val())+1);
            
            var txtLinea='<div class="col-md-12 col-lg-12 col-sm-12" id="linea'+linea+'">'+
                                '<div class="thumbnail row">'+
                                    '<div class="caption">'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group" id="groupCheck'+linea+'" style="float: right;">'+
                                                '<label for="Cantidad'+linea+'">&nbsp;</label><br/>'+
                                                '<input type="checkbox" id="check'+linea+'" name="check'+linea+'" onclick="sumas();calculoIRPF();" checked>&nbsp;&nbsp;'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group" id="groupCantidad'+linea+'">'+
                                                '<label for="Cantidad'+linea+'">Cantidad</label>'+
                                                '<input type="number" step="any" min="0" class="form-control" id="Cantidad'+linea+'" name="Cantidad'+linea+'" maxlength="20" '+
                                                        'onkeypress="limpiarCantidad('+linea+');DesactivaImprimir();" style="text-align:right;" value=""'+
                                                        'onblur="calculoCantidad('+linea+');sumasPresupuesto();calculoIRPF();formatear(this);" pattern="" readonly>'+
                                                '<div class="alert alert-dander" role="alert" style="display: none;" id="txtCantidad'+linea+'">'+
                                                    '<small class="help-block text-danger">Es numérico</small>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-5">'+
                                            '<div class="form-group" id="groupConcepto'+linea+'">'+
                                                '<label for="Concepto'+linea+'">Concepto</label>'+
                                                '<textarea class="form-control" id="Concepto'+linea+'" name="Concepto'+linea+'" rows="0" '+
                                                'onfocus="limpiarConcepto('+linea+');" onkeypress="DesactivaImprimir();" onblur="comprobar('+linea+');SiEsArticuloRellenar(this,IdArticulo'+linea+','+linea+');" readonly></textarea>'+
                                                '<div class="alert alert-dander" role="alert" style="display: none;" id="txtConcepto'+linea+'">'+
                                                    '<small class="help-block text-danger">Debe rellenar el concepto</small>'+
                                                '</div>'+
                                                '<input type="hidden" id="IdArticulo'+linea+'" name="IdArticulo'+linea+'" value="null"/>'+
                                                '<input type="hidden" id="IdPresupuesto'+linea+'" name="IdPresupuesto'+linea+'" value="null"/>'+
                                                '<input type="hidden" id="NumLineaPresup'+linea+'" name="NumLineaPresup'+linea+'" value="null"/>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group" id="groupPrecio'+linea+'">'+
                                                '<label for="Precio'+linea+'">Precio</label>'+
                                                '<input type="number" step="any" class="form-control" id="Precio'+linea+'" name="Precio'+linea+'" maxlength="20" value=""'+
                                                        'onkeypress="limpiarPrecio('+linea+');DesactivaImprimir();" style="text-align:right;" value=""'+
                                                        'onblur="calculoPrecio('+linea+');sumasPresupuesto();calculoIRPF();formatear(this);" readonly>'+
                                                '<div class="alert alert-dander" role="alert" style="display: none;" id="txtPrecio'+linea+'">'+
                                                    '<small class="help-block text-danger">Es numérico</small>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group" id="groupImporte'+linea+'">'+
                                                '<label for="Importe'+linea+'">Importe</label>'+
                                                '<input type="number" step="any" class="form-control" id="Importe'+linea+'" name="Importe'+linea+'" maxlength="20" value=""'+
                                                        'onkeypress="limpiarImporte('+linea+');DesactivaImprimir();" style="text-align:right;" value=""'+
                                                        'onblur="calculoImporte('+linea+');sumasPresupuesto();calculoIRPF();formatear(this);" readonly>'+
                                                '<div class="alert alert-dander" role="alert" style="display: none;" id="txtImporte'+linea+'">'+
                                                    '<small class="help-block text-danger">No puede ser cero</small>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-1">'+
                                            '<div class="form-group" id="groupIVA'+linea+'">'+
                                                '<label for="IVA'+linea+'">IVA</label>'+
                                                '<input type="number" step="any" class="form-control" id="IVA'+linea+'" name="IVA'+linea+'" maxlength="20" value="21"'+
                                                        'onkeypress="limpiarIVA('+linea+');DesactivaImprimir();" style="text-align:right;" value=""'+
                                                        'onblur="calculoIVA('+linea+');sumasPresupuesto();calculoIRPF();formatear(this);" readonly>'+
                                                '<div class="alert alert-dander" role="alert" style="display: none;" id="txtIVA'+linea+'">'+
                                                    '<small class="help-block text-danger">Es numérico</small>'+
                                                '</div>'+
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
                                        
                                    '</div>'+
                                '</div>'+
                            '</div>';
            
            var div = $(txtLinea);
            $("#conceptos").append(div);
            $("#Concepto"+linea).autoResize();
            
            <?php
            //esta opcion de autocomplete de articulos del concepto, esta habilitada si esta en
            //parametros generales la variable 'articulos' en 'on'
            if($datos->articulos === 'SI'){
            ?>

                $("#Concepto"+linea).autocomplete({
                    source: "{{ URL::asset('presupuestos/buscar_articulos') }}"
                }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                    var txt=item.value;
                    var inner_html = "<a><font color='Teal'>"+txt+"</font></a>";
                    return $( "<li></li>" )
                        .data( "item.autocomplete", item )
                        .append(inner_html)
                        .appendTo( ul );
                };
            <?php
            }
            ?>
            
        }
        
       
        //sumas de los importes, cuotas y totales
        function sumas(){

            var importeTotal=0;
            var cuotaTotal=0;
            var total=0;

            $('#presupuestoForm').find("input[type=checkbox]").each(function(){
                var elemento=this;
                //comprobamos el nombre del elemento y lo guardamos en ua array segun sea cantidad, precio, importe y concepto
                var nombreElemento=elemento.name;

                if(document.getElementById(nombreElemento).checked){//comprobación del check
                    //sumo el importe
                    var nombreImporte='Importe'+nombreElemento.substring(5);
                    importeTotal=parseFloat(importeTotal)+parseFloat(document.getElementById(nombreImporte).value);
                    //sumo la cuota
                    var nombreCuota='Cuota'+nombreElemento.substring(5);
                    cuotaTotal=parseFloat(cuotaTotal)+parseFloat(document.getElementById(nombreCuota).value);
                }    
            });

            importeTotal=parseFloat(importeTotal).toFixed(2);
            cuotaTotal=parseFloat(cuotaTotal).toFixed(2);

            total=parseFloat(importeTotal)+parseFloat(cuotaTotal);
            total=parseFloat(total).toFixed(2);

            importeTotal=(importeTotal.toString());
            document.presupuestoForm.totalImporte.value=importeTotal;

            cuotaTotal=(cuotaTotal.toString());
            document.presupuestoForm.totalCuota.value=cuotaTotal;

            total=(total.toString());
            document.presupuestoForm.Total.value=total;
        }
        
        
        
        
        
        function formatear(objeto){
            objeto.value = parseFloat(objeto.value).toFixed(2);
        }
        
        function limpiarCantidad(linea){
            $('#txtCantidad'+linea).css({"display": "none"});
            $('#groupCantidad'+linea).removeClass("has-feedback has-error");
        }

        function limpiarPrecio(linea){
            $('#txtPrecio'+linea).css({"display": "none"});
            $('#groupPrecio'+linea).removeClass("has-feedback has-error");
        }

        function limpiarConcepto(linea){
            $('#txtConcepto'+linea).css({"display": "none"});
            $('#groupConcepto'+linea).removeClass("has-feedback has-error");
        }

        function limpiarImporte(linea){
            $('#txtImporte'+linea).css({"display": "none"});
            $('#groupImporte'+linea).removeClass("has-feedback has-error");
        }

        function limpiarIVA(linea){
            $('#txtIVA'+linea).css({"display": "none"});
            $('#groupIVA'+linea).removeClass("has-feedback has-error");
        }
        
        
        function SiEsArticuloRellenar(concepto,IdArticulo,linea){
            //si IdArticulo.value=null, e que es la primera vez que se mete datos en este campo, asi está activado el autocomplete
            //una vez rellenado, si se vuelve a este campo ya no te sale el autocomplete, tenga el IdArticulo datos o no (este vacio)
            //if(IdArticulo.value === 'null'){
            <?php
                if($datos->articulos === 'SI'){
                    ?>

                    //busco si existe este articulo y me traigo sus datos
                    $.ajax({
                        data:{"concepto":concepto.value},  
                        url: "{{ URL::asset('presupuestos/datos_articulo') }}",
                        type:"get",
                        success: function(data) {
                            var datos = JSON.parse(data);
                            //si hay datos actualizamos en todos los campos de esta linea con los datos que viene de AJAX
                            if(!$.isEmptyObject(datos)){
                                //compruebo qsi existe esta propiedad del objeto, si es asi actualizo ese campo
                                if(datos[0].IdArticulo){
                                    $('#IdArticulo'+linea).val(datos[0].IdArticulo);
                                }
                                if(datos[0].Precio){
                                    $('#Precio'+linea).val(datos[0].Precio);
                                }
                                if(datos[0].tipoIVA){
                                    $('#IVA'+linea).val(datos[0].tipoIVA);
                                }

                                calculoPrecio(linea);
                                sumasPresupuesto();
                                calculoIRPF();
                            //sino 
                            }else{
                                //$(precioHidden).val(desFormateaNumeroContabilidad(precio.value));
                            }

                            //ir a precio (focus)
                            //$(precio).focus();
                        }
                    });
                    <?php
                }else{
                ?>
                //solo indicamos que el IdArticulo es 0
                $(IdArticulo).val('0');
                <?php
                }
            ?>
            //}
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
                //$('#Proforma').val('<?php echo $presupuesto->Proforma; ?>');
                
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
                $('#IdPresupuesto'+lineaAux).val('<?php echo $presupuestoDetalle[$i]->IdPresupuesto; ?>');
                $('#NumLineaPresup'+lineaAux).val('<?php echo $presupuestoDetalle[$i]->NumLineaPresup; ?>');
                $('#Precio'+lineaAux).val(parseFloat(<?php echo $presupuestoDetalle[$i]->ImporteUnidad; ?>).toFixed(2));
                $('#Importe'+lineaAux).val(parseFloat(<?php echo $presupuestoDetalle[$i]->Importe; ?>).toFixed(2));
                $('#IVA'+lineaAux).val(parseFloat(<?php echo $presupuestoDetalle[$i]->TipoIVA; ?>).toFixed(2));
                $('#Cuota'+lineaAux).val(parseFloat(<?php echo $presupuestoDetalle[$i]->CuotaIva; ?>).toFixed(2));
                $('#Total'+lineaAux).val(parseFloat(<?php echo ((float)$presupuestoDetalle[$i]->Importe + (float)$presupuestoDetalle[$i]->CuotaIva); ?>).toFixed(2));
                //actualizo las sumas
                sumasPresupuesto();
                calculoIRPF();
                //aumento el contador
                //$('#numLinea').val(parseInt($('#numLinea').val())+1);

                <?php
                }
            }
            ?>
        
        <?php
        //veo si es nuevo o es edicion
        if($presupuesto === ''){
            //si es nueva se desactiva la impresion y Enviar
            echo "DesactivaImprimir();";
        }else{
        }
        
        
        ?>
        
        });
        
        function DesactivaImprimir(){
            $('#btnVerPDF').attr("disabled",true);
            $('#btnEnviar').attr("disabled",true);
        }
        
        
        
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
                        <label for="Total">Suma</label>
                        <input type="text" class="form-control" style="text-align:right;" id="Total" name="Total" readonly value="">
                    </div>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            
            <?php
            $display = 'none;';
            $IRPF = 0;
            if($datos->TipoIRPF !== 'NO'){
                $display = 'block;';
                $IRPF = $datos->TipoIRPF;
            } 
            if($presupuesto !== ''){
                if($presupuesto->Retencion !== 0){
                    $display = 'block;';
                    $IRPF = $presupuesto->Retencion;
                } 
            }
            ?>
            <div class="caption" style="display:<?php echo $display; ?>">
                <div class="col-md-7">
                    <label for=""></label>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="Retencion">Retención</label>
                        <input type="number" step="any" class="form-control" style="text-align:right;" id="Retencion" name="Retencion" 
                               onblur="calculoIRPF();" value="{{ $IRPF }}">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="RetencionCuota">Cuota</label>
                        <input type="text" class="form-control" style="text-align:right;" id="RetencionCuota" name="RetencionCuota" readonly value="">
                    </div>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            
            <div class="caption">
                <div class="col-md-7">
                    <label for=""></label>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="TotalNeto">Total</label>
                        <input type="text" class="form-control" style="text-align:right;" id="TotalNeto" name="TotalNeto" readonly value="">
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
                        <input type="text" class="form-control" id="FormaPago" name="FormaPago" style="text-align:right;" 
                               value="" readonly>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-3">
<!--                    <div class="form-group">
                        <label for="Proforma">Factura Proforma:</label>
                        <input type="text" class="form-control" id="Proforma" name="Proforma" style="text-align:right;" 
                               value="" readonly>
                    </div>-->
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="validez">Fecha Validez</label>
                        <input type="text" class="form-control" id="FechaVtoPresupuesto" name="FechaVtoPresupuesto" style="text-align:right;" 
                               value="{{ $fechaVtoPresupuesto }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="caption">
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-1">
                </div>
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
<!--                    <div class="form-group">
                        <input type="button" id="submitir" class="btn btn-default" value="Guardar" onclick="submitDatos();">
                    </div>-->
                </div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">
                </div>
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <input type="button" id="submitir" class="btn btn-success" value="OK" onclick="submitDatos();">
                        <script>
//                        function verPDF(){
//                            window.open('{{ URL::asset("presupuestos/verPDF") }}<?php //echo "/" . $idPresupuesto; ?>/ver', '', 'scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no,location=no');
//                        }
                        </script>
                    </div>
                </div>
                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">
                </div>
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
<!--                    <div class="form-group">
                        <input type="button" id="btnEnviar" class="btn btn-success" value="Enviar" onclick="" data-toggle="modal" data-target="#formEnviar">
                    </div>-->
                </div>
                
            </div>
        </div>
        
        
        <!--<input type="hidden" id="idCliente" name="idCliente" value="" />-->
    </div>
</form>

<!-- Modal Enviar 
<div class="modal fade" id="formEnviar" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
             Modal Header 
            <div class="modal-header">
                <button type="button" class="close" 
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Enviar Presupuesto
                </h4>
            </div>

             Modal Body 
            <div class="modal-body">

                <form class="form-horizontal" id="enviarForm" name="enviarForm" role="form" action="{{ URL::asset('presupuestos/verPDF') }}<?php echo "/" . $idPresupuesto; ?>/enviar" method="get">
                     CSRF Token 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label  class="col-sm-4 control-label"
                                for="motivo">Para</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value=""
                                   id="email" name="email" placeholder="E-mail"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label"
                                for="motivo">CC</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value=""
                                   id="emailCC" name="emailCC" placeholder="E-mail CC"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label"
                                for="motivo">Mensaje</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="4"></textarea>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">OK</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>   -->


<script>
    function limpiar(group,txt){
        $('#'+txt).css({"display": "none"});
        $('#'+group).removeClass("has-feedback has-error");
    }
    
    function validar(objeto,group,txt){
        if(objeto.value === ''){
            $('#'+txt).css({"display": "block"});
            $('#'+group).addClass("has-feedback has-error");
        }
    }
    
    function cargaCliente(IdCliente){
        //formateo el campo por si esta señalado de anteriores validaciones
        $('#txtIdCliente').css({"display": "none"});
        $('#groupIdCliente').removeClass("has-feedback has-error");
        
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
                    $('#email').val(cliente.email);
                    //$('#FormaPago').val(cliente.forma_pago_habitual);
                }
            });
        }
    }

    function submitDatos(){
        var esValido = $('#esValido');
        esValido.value = "true";
        textoError='';


        //reviso los campos de la cabecera 
        //numPresupuesto 
        if($('#numPresupuesto').val() === ''){
            $('#txtValidarNumPresupuesto').css({"display": "block"});
            $('#groupNumPresupuesto').addClass("has-feedback has-error");
            esValido.value = "false";
        }
        
        //idCliente 
        if($('#idCliente').val() === ''){
            $('#txtIdCliente').css({"display": "block"});
            $('#groupIdCliente').addClass("has-feedback has-error");
            esValido.value = "false";
        }
        

        //revisamos toda la tabla de lineas de presupuesto, hay que revisar cantidad, precio, concepto
        // importe que se cumpla importe = cantidad x precio
        var cantidades = new Array();
        var precios = new Array();
        var importes = new Array();
        var conceptos = new Array();
        
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
        
        //compruebo que los arrays lleven datos (lentgh)
        //si fuese 0 es que no se a introducido ninguna linea de factura y eso es incongruente
        if(cantidades.length === 0){
            $('#txtAddConcepto').css({"display": "block"});
            $('#groupAddConcepto').addClass("has-feedback has-error");
            esValido.value = 'false';
        }


        var falloComp = 'NO';
        var falloImporte0 = 'NO';
        var falloConceptoVacio = 'NO';

        for(i=0;i<cantidades.length;i++){
            //comprobamos que este control existe
            if(typeof cantidades[i] !== 'undefined' && cantidades[i] !== 'null'){
                //si precios[i] o cantidades[i] esta vacio
                if(isNaN(parseFloat(precios[i])) || isNaN(parseFloat(cantidades[i]))){
                    //veo que importes[i] no sea 0
                    var importeNumero = parseFloat(importes[i]);
                    if(importeNumero === 0 || isNaN(importeNumero)){
                        //importe es 0 o NaN
                        esValido.value = 'false';
                        $('#txtImporte'+i).css({"display": "block"});
                        $('#groupImporte'+i).addClass("has-feedback has-error");
                    }
//                }else{
//                    //compruebo que importe= cantidad x precio en esta linea
//                    if(cantidades[i] === 0 || precios[i] === 0 || cantidades[i] === '0.00' || precios[i] === '0.00' ||
//                       cantidades[i] === '' || precios[i] === ''){
//                        //nada
//                    }else{
//                        var importeComp = parseFloat(cantidades[i]) * parseFloat(precios[i]);
//                        importeComp = parseFloat(importeComp).toFixed(2);
//                        if(importeComp !== parseFloat(importeNumero).toFixed(2)){
//                            esValido.value = 'false';
//                            $('#txtImporte'+i).css({"display": "block"});
//                            $('#groupImporte'+i).addClass("has-feedback has-error");
//                        }
//                    }
                }
                //ahora compruebo que los cnceptos tengan datos
                if(conceptos[i] === ''){
                    esValido.value = 'false';
                    $('#txtConcepto'+i).css({"display": "block"});
                    $('#groupConcepto'+i).addClass("has-feedback has-error");
                }
            }
        }

        //comprobamos que las sumas esten bien (no salga NaN)
        if($('#totalImporte').val() === 'NaN'){
            $('#totalImporte').val('');
        }
        if($('#totalCuota').val() === 'NaN'){
            $('#totalCuota').val('');
        }
        if($('#Total').val() === 'NaN'){
            $('#Total').val('');
        }
            
            

        //compruebo si esValido.value viene en false, si es asi indico el error
//        if(esValido.value === 'false'){
//            if(falloComp === 'SI'){
//                textoError = textoError + "Los datos introducidos no son correctos, hay una incongruencia en cantidad, precio e importe.\n";
//            }
//            if(falloImporte0 === 'SI'){
//                textoError = textoError + "El importe debe ser un valor positivo.\n";
//            }
//            if(falloConceptoVacio === 'SI'){
//                textoError = textoError + "Debe haber algún dato en el concepto.\n";
//            }
//        }



        //indicar el mensaje de error si es 'esValido.value'='false'
//        if (esValido.value === 'false'){
//            //$('#submitir').prop( "disabled", true );
////            if(textoError === ''){
////                textoError = 'Revise los datos. NO estan correctos';
////            }
////            alert(textoError);
//        }

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
            //alert('submite');
            document.presupuestoForm.submit();
        }else{
            return false;
        }  
    }
</script>



@stop



