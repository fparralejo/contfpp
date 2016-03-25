@extends('layout')


@section('principal')
<h4><span>Datos</span></h4>
<br/>
<hr/>



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

<form role="form" class="form-horizontal" id="datosForm" name="datosForm" 
      action="{{ URL::asset('clientes') }}" method="post">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
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
        <div class="col-md-11">
            <div class="form-group">
                <label for="identificacion">Nombre de la Empresa:</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion"  maxlength="150" required="true">
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
                <label for="provincia">Forma Pago Habitual:</label>
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


    <input type="hidden" id="idCliente" name="idCliente" value="" />
    <input type="submit" id="submitir" class="btn btn-default" value="Nuevo" />
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



<?php
if(!empty($errores)){
?>
<div class="alert alert-warning" id="accionTabla2" role="alert" style="display: block; ">
        {{ $errores }}
</div>
<?php
}
?>
@stop



