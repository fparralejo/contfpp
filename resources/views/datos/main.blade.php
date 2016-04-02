@extends('layout')

<?php
//decodifico los datos JSON
$datos = json_decode($datos); 
$TipoContador = json_decode($TipoContador); 


//dd($TipoContador);die;
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
      action="{{ URL::asset('clientes') }}" method="post" enctype="multipart/form-data">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <hr/>
    <div class="row">
        <div class="col-md-11">
            <div class="form-group">
                <label for="identificacion">Nombre de Empresa:</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion"
                       maxlength="150" required="true" value="{{ $datos[0]->identificacion }}">
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
    
    <hr/>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="tipo_contador">Logo:</label>
                <input type="file" class="form-control" id="doc" name="doc" onchange="check_fileConsulta(this);" /><br/>
                <span class="nombreCampo" id="txt_file">El documento debe ser JPG, PNG y no superior a 100 kB</span><br/>
                <script>
                function check_fileConsulta(file){
                    var respuesta = true;
                    $.ajax({
                        data:{"file":file.value},  
                        url: '{{ URL::asset("datos/logo") }}',
                        type:"get",
                        success: function(data) {
                          $('#txt_file').html(data);
                          if(data != ''){
                              respuesta = false;
                          }
                        }
                    });
                }
                </script>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
              <div id="logoEmp">
                  <span id="img_file">
                      <img id="imagen" height="70" width="140" src="{{ URL::asset('images/').'/'.$datos[0]->Logo }}" />
                  </span><br/>
              </div>
            </div>
        </div>
    </div>
    
    <hr/>


    
    
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

<script language="JavaScript">
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.getElementById('img_file');
          span.innerHTML = ['<img width="140" height="70" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('doc').addEventListener('change', handleFileSelect, false);

</script>


@stop



