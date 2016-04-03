@extends('layout')

<?php
$tipo = json_decode($tipo);

if($tipo === 'C'){
    $titulo = 'Clientes';
    $titulo1 = 'Cliente';
    $tipoOpc = 'C';
}else{
    $titulo = 'Proveedores';
    $titulo1 = 'Proveedor';
    $tipoOpc = 'P';
}

?>

@section('principal')
<h4><span>{{ $titulo }}</span></h4>
<br/>

<style>
    .sgsiRow:hover{
        cursor: pointer;
    }

</style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
        $('#clientes').dataTable({
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
                { "sType": 'string' }
            ],                    
            "bJQueryUI":true,
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
        });
	});


	function leerCliente(idCliente){
            $.ajax({
              data:{"idCliente":idCliente},  
              url: '{{ URL::asset("cliente/show") }}',
              type:"get",
              success: function(data) {
                var cliente = JSON.parse(data);
                $('#idCliente').val(cliente.idCliente);
                $('#nombre').val(cliente.nombre);
                $('#apellidos').val(cliente.apellidos);
                $('#telefono').val(cliente.telefono);
                $('#email').val(cliente.email);
                $('#notas').val(cliente.notas);
                $('#nombreEmpresa').val(cliente.nombreEmpresa);
                $('#cifnif').val(cliente.CIF);
                $('#direccion').val(cliente.direccion);
                $('#municipio').val(cliente.municipio);
                $('#CP').val(cliente.CP);
                $('#provincia').val(cliente.provincia);
                $('#forma_pago_habitual').val(cliente.forma_pago_habitual);
                //cambiar nombre del titulo del formulario
                $("#tituloForm").html('Editar Cliente');
                $("#submitir").val('OK');
              }
            });
	}

	function borrarCliente(idCliente, tipo){
            var tipoTxt = 'cliente';
            if(tipo === 'P'){
                tipoTxt = 'proveedor';
            }
            if (confirm("¿Desea borrar el "+tipoTxt+"?"))
            {
                $.ajax({
                  data:{"idCliente":idCliente},  
                  url: '{{ URL::asset("cliente/delete") }}',
                  type:"get",
                  success: function(data) {
                      $('#accionTabla').html(data);
                      $('#accionTabla').show();
                  }
                });
                setTimeout(function ()
                {
                    if(tipo === 'C'){
                        document.location.href='{{ URL::asset("clientes") }}';
                    }else{
                        document.location.href='{{ URL::asset("proveedores") }}';
                    }
                }, 2000);
            }
	}


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



<table id="clientes" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>{{ $titulo1 }}</th>
            <th>Teléfono</th>
            <th>E-mail</th>
            <th>NIF/CIF</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    //decodifico los datos JSON
    $clientes = json_decode($clientes); 
    ?>   
    @foreach ($clientes as $cliente)
    <?php
    //carga los datos en el formulario para editarlos
    $url="javascript:leerCliente(".$cliente->idCliente.");";
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $cliente->nombre . ' ' . $cliente->apellidos }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $cliente->telefono }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $cliente->email }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $cliente->CIF }}</td>
            <td>
                <button type="button" onclick="borrarCliente({{ $cliente->idCliente }},'{{ $cliente->tipo }}')" class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<br/><br/><br/><br/><br/>

<h4><span id="tituloForm">{{ $titulo1 }} Nuevo</span></h4>
<hr/>

<style type="text/css">
#productForm .inputGroupContainer .form-control-feedback,
#productForm .selectContainer .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<form role="form" class="form-horizontal" id="misdatosForm" name="misdatosForm" action="{{ URL::asset('clientes') }}" method="post">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <p>Contacto</p>
    <hr/>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre"  maxlength="50" required="true">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos"  maxlength="150">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="telefono">teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="15">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="100">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="notas">Notas:</label>
                <textarea class="form-control" rows="4" name="notas" id="notas"></textarea>
            </div>
        </div>
    </div>

    <br/>
    <br/>
    <p>Empresa</p>
    <hr/>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="nombreEmpresa">Nombre:</label>
                <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa"  maxlength="50">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="cifnif">CIF/NIF:</label>
                <input type="text" class="form-control" id="cifnif" name="cifnif"  maxlength="20">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion"  maxlength="100">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" class="form-control" id="municipio" name="municipio"  maxlength="50">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="CP">C. Postal:</label>
                <input type="text" class="form-control" id="CP" name="CP"  maxlength="5">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" class="form-control" id="provincia" name="provincia"  maxlength="30">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="forma_pago_habitual">Forma Pago Habitual:</label>
                <select class="form-control" id="forma_pago_habitual" name="forma_pago_habitual">
                    <option value=""></option>
                    <option value="contado">Contado</option>
                    <option value="pagare">Pagaré</option>
                    <option value="recibo">Recido</option>
                    <option value="talon">Talón</option>
                    <option value="transferencia">Transferencia</option>
                </select>
            </div>
        </div>
    </div>

    <br/>


    <input type="hidden" id="tipoOpc" name="tipoOpc" value="{{ $tipoOpc }}" />
    <input type="hidden" id="idCliente" name="idCliente" value="" />
    <input type="submit" id="submitir" class="btn btn-default" value="Nuevo"/>
</form>

<script>
$(document).ready(function() {
    $('#misdatosForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombre: {
                validators: {
                    notEmpty: {
                        message: 'El nombre es obligatorio'
                    }
                }
            }
        }
    });
});

</script>

@stop



