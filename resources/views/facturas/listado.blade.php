@extends('layout')

<?php
$facturas = json_decode($facturas);
$pedidos = json_decode($pedidos);
$presupuestos = json_decode($presupuestos);
$clientes = json_decode($clientes);
//dd($facturas);
?>

@section('principal')
<h4><span>Listado Facturas</span></h4>
<br/>

<!--<script>
//hacer desaparecer en cartel
    $(document).ready(function () {
        setTimeout(function () {
            $("#accionTabla2").fadeOut(1500);
        }, 3000);
    });
</script>

@if (Session::has('errors'))
<div class="alert alert-success" id="accionTabla2" role="alert" style="display: block; ">
    <?php //echo json_decode($errors); ?>
</div>
@endif-->

<style>
    .sgsiRow:hover{
        cursor: pointer;
    }

</style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
        $('#presupuestos').dataTable({
        	"responsive": true,
            "bProcessing": true,
            "sPaginationType":"full_numbers",
            "oLanguage": {
                "sLengthMenu": "Ver _MENU_ registros por pagina",
                "sZeroRecords": "No se han encontrado registros",
                "sInfo": "Ver _START_ al _END_ de _TOTAL_ Registros",
                "sInfoEmpty": "Ver 0 al 0 de 0 registros",
                "sInfoFiltered": "(filtrados _MAX_ total registros)",
                "sSearch": "Busqueda:",
                "oPaginate": { 
                    "sLast": "Última página", 
                    "sFirst": "Primera", 
                    "sNext": "Siguiente", 
                    "sPrevious": "Anterior" 
                }
            },
            "bSort":true,
            "aaSorting": [[ 0, "asc" ]],
            "aoColumns": [
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' },
                null,
                null,
                null
            ],                    
            "bJQueryUI":true,
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
        });
	});



	//hacer desaparecer en cartel
	$(document).ready(function() {
	    setTimeout(function() {
	        $("#accionTabla2").fadeOut(1500);
	    },3000);
	});


        
</script>



<!-- aviso de alguna accion -->
<div class="alert alert-success" role="alert" id="accionTabla" style="display: none; ">
</div>

@if (Session::has('errors'))
<div class="alert alert-success" id="accionTabla2" role="alert" style="display: block; ">
{{ json_decode($errors) }}
</div>
@endif


<script>
function actualizarEstadoFactura(IdFactura,opcion){
    $.ajax({
        data:{"IdFactura":IdFactura,"opcion":opcion},  
        url: "{{ URL::asset('facturas/actualizarEstado') }}",
        type:"get"
    });
}
</script>

<table id="presupuestos" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="width: 7%;">Nº Factura</th>
            <th style="width: 7%;">Nº Presupuesto</th>
            <th style="width: 7%;">Nº Pedido</th>
            <th style="width: 30%;">Cliente</th>
            <th style="width: 10%;">Fecha</th>
            <th style="width: 10%;">Importe</th>
            <th style="width: 15%;">Estado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th style="width: 7%;"></th>
            <th style="width: 7%;"></th>
            <th style="width: 7%;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($facturas as $factura)
    <?php
    //cliente
    $txtCliente = '';
    foreach ($clientes as $cliente) {
        if((int)$cliente->idCliente === (int)$factura->IdCliente){
            $txtCliente = $cliente->nombre . ' ' . $cliente->apellidos;
            break;
        }
    }
    //presupuesto
    $numPresupuesto = '';
    foreach ($presupuestos as $presupuesto) {
        if((int)$presupuesto->IdPresupuesto === (int)$factura->IdPresupuesto){
            $numPresupuesto = $presupuesto->NumPresupuesto;
            break;
        }
    }
    //factura
    $numPedido = '';
    foreach ($pedidos as $pedido) {
        if((int)$pedido->IdPedido === (int)$factura->IdPedido){
            $numPedido = $presupuesto->NumPedido;
            break;
        }
    }
    //estado, si está Emitida,Contabilizada,Anulada se presenta en un select, si está Contabilizada se escribe directamente
    $htmlEstado = '';
    if($factura->Estado === 'Emitida'){
        $htmlEstado = '<select class="form-control" name="Estado" id="Estado" onchange="actualizarEstadoFactura(' . $factura->IdFactura . ',this.value);">';
        $htmlEstado = $htmlEstado . '<option value="Emitida" selected>Emitida</option>';
        $htmlEstado = $htmlEstado . '<option value="Anulada">Anulada</option>';
        $htmlEstado = $htmlEstado . '</select>';
    }else if($factura->Estado === 'Anulada'){
        $htmlEstado = '<select class="form-control" name="Estado" id="Estado" onchange="actualizarEstadoFactura(' . $factura->IdFactura . ',this.value);">';
        $htmlEstado = $htmlEstado . '<option value="Emitida">Emitida</option>';
        $htmlEstado = $htmlEstado . '<option value="Anulada" selected>Anulada</option>';
        $htmlEstado = $htmlEstado . '</select>';
    }else if($factura->Estado === 'Contabilizada'){
        $htmlEstado = 'Contabilizada';
    }
    
    //carga los datos en el formulario para editarlos
    //$url="javascript:leerCliente(".$presupuesto->IdPresupuesto.");";
    $url="";
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}" style="text-align: right;"><?php echo $factura->NumFactura; ?></td>
            <td class="sgsiRow" onClick="{{ $url }}" style="text-align: right;"><?php echo $numPresupuesto; ?></td>
            <td class="sgsiRow" onClick="{{ $url }}" style="text-align: right;"><?php echo $numPedido; ?></td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $txtCliente }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$factura->FechaFactura)->format('d/m/Y') }}</td>
            <td class="sgsiRow" style="text-align: right;" onClick="{{ $url }}">{{ number_format($factura->total, 2, ',', '.') }}</td>
            <td class="sgsiRow" onClick="{{ $url }}"><?php echo $htmlEstado; ?></td>
            <td>
                <button type="button" onclick="verFactura({{ $factura->IdFactura }})" class="btn btn-xs btn-primary">Ver/Editar</button>
            </td>
            <td>
                <button type="button" onclick="duplicarFactura({{ $factura->IdFactura }})" class="btn btn-xs btn-success">Duplicar</button>
            </td>
            <td>
                @if($pedido->Facturada === 'NF')
                <button type="button" onclick="borrarFactura({{ $factura->IdFactura }})" class="btn btn-xs btn-danger">Borrar</button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    function verFactura(IdFactura){
        location.href = "{{ URL::asset('facturas/editar/') }}/"+IdFactura;
    }
    function duplicarFactura(IdFactura){
        if (confirm("¿Desea duplicar esta factura?"))
        {
            location.href = "{{ URL::asset('facturas/duplicar/') }}/"+IdFactura;
        }
    }
    function borrarFactura(IdFactura){
        if (confirm("¿Desea borrar esta factura?"))
        {
            location.href = "{{ URL::asset('facturas/borrar/') }}/"+IdFactura;
        }
    }
</script>


@stop



