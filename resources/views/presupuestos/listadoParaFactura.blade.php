@extends('layout')

<?php
$presupuestos = json_decode($presupuestos);
$facturas = json_decode($facturas);
$clientes = json_decode($clientes);

//dd($pedidos);
?>

@section('principal')
<h4><span>Listado Presupuestos para Preparar Factura</span></h4>
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
function actualizarEstadoPresupuesto(IdPresupuesto,opcion){
    $.ajax({
        data:{"IdPresupuesto":IdPresupuesto,"opcion":opcion},  
        url: "{{ URL::asset('presupuestos/actualizarEstado') }}",
        type:"get",
        success: function(data) {
            if(opcion === 'Aceptado'){
                $('#tdAccion'+IdPresupuesto).html('<button type="button" onclick="prepararFactura('+IdPresupuesto+')" class="btn btn-xs btn-success">Preparar Factura</button>');
            }else{
                $('#tdAccion'+IdPresupuesto).html('');
            }
        }
    });
}
</script>

<table id="presupuestos" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="width: 10%;">Nº Presupuesto</th>
            <th style="width: 40%;">Cliente</th>
            <th style="width: 12%;">Fecha</th>
            <th style="width: 12%;">Importe</th>
            <th style="width: 16%;">Estado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th style="width: 10%;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($presupuestos as $presupuesto)
    @if($presupuesto->Facturada !== 'T' && $presupuesto->Pedido === 'NP')
    <?php
    //cliente
    $txtCliente = '';
    foreach ($clientes as $cliente) {
        if((int)$cliente->idCliente === (int)$presupuesto->IdCliente){
            $txtCliente = $cliente->nombre . ' ' . $cliente->apellidos;
            break;
        }
    }
    //estado, si está Emitida o Anulada se presenta en un select, si está Contabilizada se escribe directamente
    $htmlEstado = '<select class="form-control" name="Estado" id="Estado" onchange="actualizarEstadoPresupuesto(' . $presupuesto->IdPresupuesto . ',this.value);">';
    if($presupuesto->Estado === 'Pendiente'){
        $htmlEstado = $htmlEstado . '<option value="Pendiente" selected>Pendiente</option>';
        $htmlEstado = $htmlEstado . '<option value="Aceptado">Aceptado</option>';
        $htmlEstado = $htmlEstado . '<option value="Rechazado">Rechazado</option>';
        $htmlEstado = $htmlEstado . '<option value="Cancelado">Cancelado</option>';
    }else if($presupuesto->Estado === 'Aceptado'){
        $htmlEstado = $htmlEstado . '<option value="Pendiente">Pendiente</option>';
        $htmlEstado = $htmlEstado . '<option value="Aceptado" selected>Aceptado</option>';
        $htmlEstado = $htmlEstado . '<option value="Rechazado">Rechazado</option>';
        $htmlEstado = $htmlEstado . '<option value="Cancelado">Cancelado</option>';
    }else if($presupuesto->Estado === 'Rechazado'){
        $htmlEstado = $htmlEstado . '<option value="Pendiente">Pendiente</option>';
        $htmlEstado = $htmlEstado . '<option value="Aceptado">Aceptado</option>';
        $htmlEstado = $htmlEstado . '<option value="Rechazado" selected>Rechazado</option>';
        $htmlEstado = $htmlEstado . '<option value="Cancelado">Cancelado</option>';
    }else if($presupuesto->Estado === 'Cancelado'){
        $htmlEstado = $htmlEstado . '<option value="Pendiente">Pendiente</option>';
        $htmlEstado = $htmlEstado . '<option value="Aceptado">Aceptado</option>';
        $htmlEstado = $htmlEstado . '<option value="Rechazado">Rechazado</option>';
        $htmlEstado = $htmlEstado . '<option value="Cancelado" selected>Cancelado</option>';
    }
    $htmlEstado = $htmlEstado . '</select>';
    
    //carga los datos en el formulario para editarlos
    //$url="javascript:leerCliente(".$presupuesto->IdPresupuesto.");";
    $url="";
    if($presupuesto->Facturada === 'P'){
        //busco las facturas hechas de este presupuesto
        $sumaTotal = 0;
        for ($ii = 0; $ii < count($facturas); $ii++) {
            if((int)$facturas[$ii]->IdPresupuesto === $presupuesto->IdPresupuesto){
                $sumaTotal = $sumaTotal + $facturas[$ii]->total;
            }
        }
        $total = $presupuesto->total - $sumaTotal;
    }else{
        $total = $presupuesto->total;
    }
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}" style="text-align: right;"><?php echo $presupuesto->NumPresupuesto; ?></td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $txtCliente }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$presupuesto->FechaPresupuesto)->format('d/m/Y') }}</td>
            <td class="sgsiRow" style="text-align: right;" onClick="{{ $url }}">{{ number_format($total, 2, ',', '.') }}</td>
            @if($presupuesto->Pedido === 'NP')
                <td class="sgsiRow" onClick="{{ $url }}"><?php echo $htmlEstado; ?></td>
            @else
                <td class="sgsiRow" onClick="{{ $url }}">{{ $presupuesto->Estado }}</td>
            @endif
            <td id="tdAccion{{ $presupuesto->IdPresupuesto }}">
                @if($presupuesto->Estado === 'Aceptado')
                    @if($presupuesto->Facturada !== 'T')
                    <button type="button" onclick="prepararFactura({{ $presupuesto->IdPresupuesto }})" class="btn btn-xs btn-success">Preparar Factura</button>
                    @endif
                @endif
            </td>
        </tr>
    @endif
    @endforeach
    </tbody>
</table>

<script>
    function prepararFactura(idPresupuesto){
        if (confirm("¿Desea preparar la factura de este presupuesto?"))
        {
            location.href = "{{ URL::asset('presupuestos/prepararFactura/') }}/"+idPresupuesto;
        }
    }
</script>


@stop



