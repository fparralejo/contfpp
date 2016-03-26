@extends('layout')


@section('principal')
<div  ng-controller="clienteController">
<h4><span>Clientes</span></h4>
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
                { "sType": 'numeric' },
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

        //NO SE USA
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

	function borrarCliente(idCliente){
            if (confirm("¿Desea borrar el cliente?"))
            {
                $.ajax({
                  data:{"idCliente":idCliente},  
                  url: '{{ URL::asset("cliente/delete") }}',
                  type:"get",
                  success: function(data) {
                      var datos = JSON.parse(data);
                      $('#accionTabla').html(datos);
                      $('#accionTabla').show();
                  }
                });
                setTimeout(function ()
                {
                    document.location.href='{{ URL::asset("clientes") }}';
                }, 2000);
            }
	}

//	function ofertaSeguimiento(id_oferta){
//            //vamos a la views de seguimiento con esta oferta
//            document.location.href="{{URL::to('seguimiento/"+id_oferta+"')}}";
//	}

	//hacer desaparecer en cartel
	$(document).ready(function() {
//	    setTimeout(function() {
//	        $("#accionTabla2").fadeOut(1500);
//	    },3000);
	});


        
</script>



<!-- aviso de alguna accion -->
<div class="alert alert-success" role="alert" id="accionTabla" style="display: none; ">
</div>

<div class="alert alert-success" id="accionTabla2" role="alert" style="display: block; ">
<?php //echo json_decode($errors); ?>
</div>



<table id="clientes" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
<!--            <th>Id</th>-->
            <th>Id</th>
            <th>Cliente</th>
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
    //$url="javascript:leerCliente(".$cliente->idCliente.");";
    ?>
        <tr>
            <td class="sgsiRow" ng-click="selectCliente({{ $cliente->idCliente }})">{{ $cliente->idCliente }}</td>
            <td class="sgsiRow" ng-click="selectCliente({{ $cliente->idCliente }})">{{ $cliente->nombre . ' ' . $cliente->apellidos }}</td>
            <td class="sgsiRow" ng-click="selectCliente({{ $cliente->idCliente }})">{{ $cliente->telefono }}</td>
            <td class="sgsiRow" ng-click="selectCliente({{ $cliente->idCliente }})">{{ $cliente->email }}</td>
            <td class="sgsiRow" ng-click="selectCliente({{ $cliente->idCliente }})">{{ $cliente->CIF }}</td>
            <td>
                <button type="button" ng-click="borraCliente({{ $cliente->idCliente }})" class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<br/><br/><br/><br/><br/>

<h4><span id="tituloForm">Cliente Nuevo</span></h4>
<hr/>

<style type="text/css">
#productForm .inputGroupContainer .form-control-feedback,
#productForm .selectContainer .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<form role="form" class="form-horizontal" id="clienteForm" name="clienteForm" 
      action="{{ URL::asset('clientes') }}" method="post">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <p>Contacto</p>
    <hr/>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" ng-model="nombre" maxlength="50" required="true">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" ng-model="apellidos" maxlength="150">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="telefono">teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" ng-model="telefono" maxlength="15">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" ng-model="email" maxlength="100">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="notas">Notas:</label>
                <textarea class="form-control" rows="4" name="notas" id="notas" ng-model="notas"></textarea>
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
                <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" ng-model="nombreEmpresa" maxlength="50">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="cifnif">CIF/NIF:</label>
                <input type="text" class="form-control" id="cifnif" name="cifnif" ng-model="cifnif" maxlength="20">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" ng-model="direccion" maxlength="100">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" class="form-control" id="municipio" name="municipio" ng-model="municipio" maxlength="50">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="CP">C. Postal:</label>
                <input type="text" class="form-control" id="CP" name="CP" ng-model="CP" maxlength="5">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" class="form-control" id="provincia" name="provincia" ng-model="provincia" maxlength="30">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="provincia">Forma Pago Habitual:</label>
                <select class="form-control" id="forma_pago_habitual" name="forma_pago_habitual" ng-model="forma_pago_habitual">
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


    <input type="hidden" id="idCliente" name="idCliente" ng-model="idCliente" value="" />
    <!--<input type="submit" id="submitir" class="btn btn-default" value="Nuevo" />-->
    <input type="button" id="submitir" class="btn btn-default" value="Nuevo" ng-click="addEdit()" />
</form>

<script>
$(document).ready(function() {
    $('#clienteForm').formValidation({
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

//Codigo Angular
var myapp = angular.module("myapp",[]).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

myapp.controller("clienteController",function($scope,$http){


//    $http.get('{{ URL::asset("clientes/listar") }}')
//            .success(function(data){
//                    //alert(data);
//                    $scope.listClientes = data;
//    });


    $scope.addEdit = function(){
        $http.post('{{ URL::asset("clientes") }}',{
                                                    idCliente: $scope.idCliente,
                                                    nombre: $scope.nombre,
                                                    apellidos: $scope.apellidos,
                                                    telefono: $scope.telefono,
                                                    notas: $scope.notas,
                                                    email: $scope.email,
                                                    nombreEmpresa: $scope.nombreEmpresa,
                                                    CIF: $scope.cifnif,
                                                    direccion: $scope.direccion,
                                                    municipio: $scope.municipio,
                                                    CP: $scope.CP,
                                                    provincia: $scope.provincia,
                                                    forma_pago_habitual: $scope.forma_pago_habitual
                                                   })
            .success(function(data,status, headers,config){
//                setTimeout(function(data) {
//                    //$("#accionTabla2").css('display':'block');
//                    $("#accionTabla2").html(data);
//                    //$("#accionTabla2").fadeOut(1500);
//                    //$("#accionTabla2").css('display':'none');
//                },3000);
                
            }
        );
        document.location.href='{{ URL::asset("clientes") }}';
    };


    //BORRAR
    $scope.edit = function(){
            $http.post("edit.php",{id: $scope.id,name:$scope.name,price:$scope.price,quantity:$scope.quantity})
                    .success(function(data,status, headers,config){
                            var index = getSelectedIndex($scope.id);
                            $scope.listProducts[index].name = $scope.name;
                            $scope.listProducts[index].price = $scope.price;
                            $scope.listProducts[index].quantity = $scope.quantity;
                    }
            );
    };

    //BORRAR
    $scope.selectEdit = function(id){
            var index = getSelectedIndex(id);
            var product = $scope.listProducts[index];
            $scope.id = product.id;
            $scope.name = product.name;
            $scope.price = product.price;
            $scope.quantity = product.quantity;
    };


    //cargar datos en el formulario de un cliente
    $scope.selectCliente = function(id){
        $http.get('{{ URL::asset("cliente/show?idCliente=") }}'+id)
            .success(function(data,status, headers,config){
                $scope.idCliente = data.idCliente;
                $scope.nombre = data.nombre;
                $scope.apellidos = data.apellidos;
                $scope.telefono = data.telefono;
                $scope.notas = data.notas;
                $scope.email = data.email;
                $scope.nombreEmpresa = data.nombreEmpresa;
                $scope.cifnif = data.CIF;
                $scope.direccion = data.direccion;
                $scope.municipio = data.municipio;
                $scope.CP = data.CP;
                $scope.provincia = data.provincia;
                $scope.forma_pago_habitual = data.forma_pago_habitual;
                //cambiar nombre del titulo del formulario
                $("#tituloForm").html('Editar Cliente');
                $("#submitir").val('OK');
            }
        );
    };

    //BORRAR
    $scope.del = function(id){
            var result = confirm('Are you sure?');
            if(result===true){
                    $http.post("delete.php",{id: id})
                            .success(function(data,status, headers,config){
                                    var index = getSelectedIndex(id);
                                    $scope.listProducts.splice(index,1);
                            }
                    );
            }

    };

    //BORRAR
    function getSelectedIndex(id){
            for(var i=0;$scope.listProducts.length; i++){
                    if($scope.listProducts[i].id==id){
                            return i;
                    }
            }
            return -1;
    };

});
</script>



<?php
if(!empty($errores)){
?>
<div class="alert alert-warning" id="accionTabla2" role="alert" style="display: block; ">
        {{ $errores }}
</div>
</div>
<?php
}
?>
@stop



