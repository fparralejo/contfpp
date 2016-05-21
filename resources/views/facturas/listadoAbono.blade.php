@extends('layout')

<?php
$facturas = json_decode($facturas);
$clientes = json_decode($clientes);
//dd($facturas);
?>

@section('principal')
<h4><span>Listado Facturas (para abonar)</span></h4>
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
            <th style="width: 40%;">Cliente</th>
            <th style="width: 10%;">Fecha</th>
            <th style="width: 14%;">Importe</th>
            <th style="width: 15%;">Estado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
    
    //carga los datos en el formulario para editarlos
    //$url="javascript:leerCliente(".$presupuesto->IdPresupuesto.");";
    $url="";
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}" style="text-align: right;"><?php echo $factura->NumFactura; ?></td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $txtCliente }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$factura->FechaFactura)->format('d/m/Y') }}</td>
            <td class="sgsiRow" style="text-align: right;" onClick="{{ $url }}">{{ number_format($factura->total, 2, ',', '.') }}</td>
            <td class="sgsiRow" onClick="{{ $url }}"><?php echo $factura->Estado; ?></td>
            <td>
                <button type="button" onclick="prepararFacturaAbono({{ $factura->IdFactura }})" class="btn btn-xs btn-primary">Preparar Abono</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    function prepararFacturaAbono(IdFactura){
        if (confirm("¿Desea preparar el abono de esta factura?"))
        {
            location.href = "{{ URL::asset('facturas/preparar_factura_abono/') }}/"+IdFactura;
        }
    }
</script>


@stop



