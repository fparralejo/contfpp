@extends('layout')

<?php
//decodifico los datos JSON
$TipoContador = json_decode($TipoContador); 


?>

@section('principal')
<h4><span>Datos</span></h4>
<br/>



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
        <div class="col-md-11">
            <div class="form-group">
                <label for="identificacion">Nombre de Empresa:</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion"  maxlength="150" required="true">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="nombre">Nick: (Sólo Lectura)</label>
                <input type="text" class="form-control" id="nombre" name="nombre"  maxlength="10" readonly>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="apellidos">Clave: (Sólo Lectura)</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="10" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="CIF">NIF/CIF:</label>
                <input type="text" class="form-control" id="CIF" name="CIF" maxlength="50">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
        </div>
    </div>

    <div class="row">
        <div class="col-md-11">
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion"  maxlength="150">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" class="form-control" id="municipio" name="municipio" maxlength="50">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="email" class="form-control" id="provincia" name="provincia" maxlength="50">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="CP">CP:</label>
                <input type="text" class="form-control" id="CP" name="CP" maxlength="11">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="email" class="form-control" id="telefono" name="telefono" maxlength="11">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="email1">Email 1:</label>
                <input type="text" class="form-control" id="email1" name="email1" maxlength="100">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="email2">Email 2:</label>
                <input type="email" class="form-control" id="email2" name="email2" maxlength="100">
            </div>
        </div>
    </div>
    
    <hr/>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="tipo_contador">Tipo Contador:</label>
                <select class="form-control" id="tipo_contador" name="tipo_contador">
                    @foreach ($TipoContador as $tipo)
                        <option value="{{ $tipo->idContador }}">{{ $tipo->tipo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="productos">Utilizar la Base de Datos de Productos:</label>
                <select class="form-control" id="productos" name="productos">
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="tipo_contador">Tipo Contador:</label>
                <input type="email" class="form-control" id="email2" name="email2" maxlength="100">
                
                
                FOTO, VER DE CONTABILIDAD
                
            </div>
        </div>
        <div class="col-md-1">
        </div>
        
        TEXTAREA DE PIE DE PAGINA
        <div class="col-md-5">
            <div class="form-group">
                <label for="productos">Utilizar la Base de Datos de Productos:</label>
                <select class="form-control" id="productos" name="productos">
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
            </div>
        </div>
    </div>
    
    
    
    <br/>

    <!--<input type="hidden" id="idCliente" name="idCliente" value="" />-->
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



