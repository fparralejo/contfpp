@extends('layout')

<?php
$pedidos = json_decode($pedidos);
$presupuestos = json_decode($presupuestos);
$clientes = json_decode($clientes);
//dd($presupuestos);
?>

@section('principal')
<h4><span>Listado Pedidos</span></h4>
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
                null,
                null,
                null
            ],                    
            "bJQueryUI":true,
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
        });
	});


//	function leerCliente(idCliente){
//            $.ajax({
//              data:{"idCliente":idCliente},  
//              url: '{{ URL::asset("cliente/show") }}',
//              type:"get",
//              success: function(data) {
//                var cliente = JSON.parse(data);
//                $('#idCliente').val(cliente.idCliente);
//                $('#nombre').val(cliente.nombre);
//                $('#apellidos').val(cliente.apellidos);
//                $('#telefono').val(cliente.telefono);
//                $('#email').val(cliente.email);
//                $('#notas').val(cliente.notas);
//                $('#nombreEmpresa').val(cliente.nombreEmpresa);
//                $('#cifnif').val(cliente.CIF);
//                $('#direccion').val(cliente.direccion);
//                $('#municipio').val(cliente.municipio);
//                $('#CP').val(cliente.CP);
//                $('#provincia').val(cliente.provincia);
//                $('#forma_pago_habitual').val(cliente.forma_pago_habitual);
//                //cambiar nombre del titulo del formulario
//                $("#tituloForm").html('Editar Cliente');
//                $("#submitir").val('OK');
//              }
//            });
//	}
//
//	function borrarCliente(idCliente, tipo){
//            var tipoTxt = 'cliente';
//            if(tipo === 'P'){
//                tipoTxt = 'proveedor';
//            }
//            if (confirm("¿Desea borrar el "+tipoTxt+"?"))
//            {
//                $.ajax({
//                  data:{"idCliente":idCliente},  
//                  url: '{{ URL::asset("cliente/delete") }}',
//                  type:"get",
//                  success: function(data) {
//                      $('#accionTabla').html(data);
//                      $('#accionTabla').show();
//                  }
//                });
//                setTimeout(function ()
//                {
//                    if(tipo === 'C'){
//                        document.location.href='{{ URL::asset("clientes") }}';
//                    }else{
//                        document.location.href='{{ URL::asset("proveedores") }}';
//                    }
//                }, 2000);
//            }
//	}


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
function actualizarEstadoPedido(IdPedido,opcion){
    $.ajax({
        data:{"IdPedido":IdPedido,"opcion":opcion},  
        url: "{{ URL::asset('pedidos/actualizarEstado') }}",
        type:"get"
    });
}
</script>

<table id="presupuestos" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="width: 7%;">Nº Pedido</th>
            <th style="width: 7%;">Nº Presupuesto</th>
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
    @foreach ($pedidos as $pedido)
    <?php
    //cliente
    $txtCliente = '';
    foreach ($clientes as $cliente) {
        if((int)$cliente->idCliente === (int)$pedido->IdCliente){
            $txtCliente = $cliente->nombre . ' ' . $cliente->apellidos;
            break;
        }
    }
    //cliente
    $numPresupuesto = '';
    foreach ($presupuestos as $presupuesto) {
        if((int)$presupuesto->IdPresupuesto === (int)$pedido->IdPresupuesto){
            $numPresupuesto = $presupuesto->NumPresupuesto;
            break;
        }
    }
    //estado, si está Emitida o Anulada se presenta en un select, si está Contabilizada se escribe directamente
    $htmlEstado = '<select class="form-control" name="Estado" id="Estado" onchange="actualizarEstadoPedido(' . $pedido->IdPedido . ',this.value);">';
    if($pedido->Estado === 'Aceptado'){
        $htmlEstado = $htmlEstado . '<option value="Aceptado" selected>Aceptado</option>';
        $htmlEstado = $htmlEstado . '<option value="Cancelado">Cancelado</option>';
    }else if($pedido->Estado === 'Cancelado'){
        $htmlEstado = $htmlEstado . '<option value="Aceptado">Aceptado</option>';
        $htmlEstado = $htmlEstado . '<option value="Cancelado" selected>Cancelado</option>';
    }
    $htmlEstado = $htmlEstado . '</select>';
    
    //carga los datos en el formulario para editarlos
    //$url="javascript:leerCliente(".$presupuesto->IdPresupuesto.");";
    $url="";
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}" style="text-align: right;"><?php echo $pedido->NumPedido; ?></td>
            <td class="sgsiRow" onClick="{{ $url }}" style="text-align: right;"><?php echo $numPresupuesto; ?></td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $txtCliente }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$pedido->FechaPedido)->format('d/m/Y') }}</td>
            <td class="sgsiRow" style="text-align: right;" onClick="{{ $url }}">{{ number_format($pedido->total, 2, ',', '.') }}</td>
            <td class="sgsiRow" onClick="{{ $url }}"><?php echo $htmlEstado; ?></td>
            <td>
                <button type="button" onclick="verPedido({{ $pedido->IdPedido }})" class="btn btn-xs btn-primary">Ver/Editar</button>
            </td>
            <td>
                <button type="button" onclick="duplicarPedido({{ $pedido->IdPedido }})" class="btn btn-xs btn-success">Duplicar</button>
            </td>
            <td>
                @if($pedido->Facturada === 'NF')
                <button type="button" onclick="borrarPedido({{ $pedido->IdPedido }})" class="btn btn-xs btn-danger">Borrar</button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    function verPedido(idPedido){
        location.href = "{{ URL::asset('pedidos/editar/') }}/"+idPedido;
    }
    function duplicarPedido(idPedido){
        if (confirm("¿Desea duplicar este pedido?"))
        {
            location.href = "{{ URL::asset('pedidos/duplicar/') }}/"+idPedido;
        }
    }
    function borrarPedido(idPedido){
        if (confirm("¿Desea borrar este pedido?"))
        {
            location.href = "{{ URL::asset('pedidos/borrar/') }}/"+idPedido;
        }
    }
</script>


@stop



