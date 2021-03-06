@extends('layout')

<?php


?>

@section('principal')
<h4><span>Base de Datos: Backup</span></h4>
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
                { "sType": 'string' }
            ],                    
            "bJQueryUI":true,
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
        });
	});


//	function leerArticulo(IdArticulo){
//            $.ajax({
//              data:{"IdArticulo":IdArticulo},  
//              url: '{{ URL::asset("articulo/show") }}',
//              type:"get",
//              success: function(data) {
//                var articulo = JSON.parse(data);
//                $('#IdArticulo').val(articulo.IdArticulo);
//                $('#Referencia').val(articulo.Referencia);
//                $('#Descripcion').val(articulo.Descripcion);
//                $('#Precio').val(parseFloat(articulo.Precio).toFixed(2));
//                $('#tipoIVA').val(articulo.tipoIVA);
//                //cambiar nombre del titulo del formulario
//                $("#tituloForm").html('Editar Artículo');
//                $("#submitir").val('OK');
//              }
//            });
//	}

//	function borrarArticulo(IdArticulo){
//            if (confirm("¿Desea borrar el artículo?"))
//            {
//                $.ajax({
//                  data:{"IdArticulo":IdArticulo},  
//                  url: '{{ URL::asset("articulo/delete") }}',
//                  type:"get",
//                  success: function(data) {
//                      $('#accionTabla').html(data);
//                      $('#accionTabla').show();
//                  }
//                });
//                setTimeout(function ()
//                {
//                    document.location.href='{{ URL::asset("articulos") }}';
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

<form role="form" class="form-horizontal" id="bbddForm" name="bbddForm" action="{{ URL::asset('bbdd/backup') }}" method="post">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">


    <table id="clientes" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="width: 5%;"></th>
                <th style="width: 90%;">Nombre</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        //decodifico los datos JSON
        $ficheros = ($ficheros); 
        //var_dump($ficheros);die;
        ?>   
        @foreach ($ficheros as $fichero)
            <?php
            //carga los datos en el formulario para editarlos
            //$url="javascript:leerArticulo(".$articulo->IdArticulo.");";
            $url="";
            ?>
            <tr>
                <td class="sgsiRow" onClick="{{ $url }}">
                    <div align="center">
                        <input type="radio" name="fichero" value="{{ $fichero['fichero'] }}" onclick="enabledBtnImportar();" /></td>
                   </div>
                <td class="sgsiRow" onClick="{{ $url }}">Backup fecha {{ $fichero['fecha'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!--<br/><br/><br/>-->

    <!--<h4><span id="tituloForm">Artículo Nuevo</span></h4>-->
    <hr/>

    <style type="text/css">
    #productForm .inputGroupContainer .form-control-feedback,
    #productForm .selectContainer .form-control-feedback {
        top: 0;
        right: -15px;
    }
    </style>

    <div class="row">
        <input type="button" id="Guardar" name="Guardar" class="btn btn-default" value="Guardar" onclick="guardar();" />
        <input type="button" id="Importar" name="Importar" class="btn btn-default" value="Importar" onclick="importar();" disabled />
        <input type="hidden" name="opcion" />
    </div>

</form>

<script>
    function guardar(){
        alert("se va proceder a hacer una copia de seguridad de la base de datos");
        document.bbddForm.opcion.value = 'guardar';
        document.bbddForm.submit();
    }
     
    function importar(){
        alert("se va proceder a importar el fichero "+document.bbddForm.fichero.value);
        document.bbddForm.opcion.value = 'importar';
        document.bbddForm.submit();
    }
    
    function enabledBtnImportar(){
        document.bbddForm.Importar.disabled = false;
    }
</script>

@stop



