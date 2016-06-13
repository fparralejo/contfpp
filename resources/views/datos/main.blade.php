@extends('layout')

<?php
//decodifico los datos JSON
$datos = json_decode($datos); 
$TipoContador = json_decode($TipoContador); 
$errors = json_decode($errors); 

//dd($datos);
?>

@section('principal')
<h4><span>Datos</span></h4>
<br/>

<script>
//hacer desaparecer en cartel
$(document).ready(function() {
    setTimeout(function() {
        $("#accionTabla2").fadeOut(1500);
    },3000);
});
</script>

@if (isset($errors) && $errors !== '')
<div class="alert alert-success" id="accionTabla2" role="alert" style="display: block; ">
<?php echo ($errors); ?>
</div>
@endif




<style type="text/css">
#datosForm .inputGroupContainer .form-control-feedback,
#datosForm .selectContainer .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<form role="form" class="form-horizontal" id="datosForm" name="datosForm" 
      action="{{ URL::asset('datos') }}" method="post" enctype="multipart/form-data">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <hr/>
    <div class="row">
        <div class="col-md-11">
            <div class="form-group">
                <label for="identificacion">Nombre de Empresa:</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion"
                       maxlength="150" required="true" value="{{ $datos->identificacion }}">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="Nombre">Nick: (Sólo Lectura)</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre"  maxlength="10" readonly value="{{ $datos->Nombre }}">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="Password">Clave: (Sólo Lectura)</label>
                <input type="text" class="form-control" id="Password" name="Password" maxlength="10" readonly value="{{ $datos->Password }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="CIF">NIF/CIF:</label>
                <input type="text" class="form-control" id="CIF" name="CIF" maxlength="50" value="{{ $datos->CIF }}">
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
                <input type="text" class="form-control" id="direccion" name="direccion"  maxlength="150" value="{{ $datos->direccion }}">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" class="form-control" id="municipio" name="municipio" maxlength="50" value="{{ $datos->municipio }}">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" class="form-control" id="provincia" name="provincia" maxlength="50" value="{{ $datos->provincia }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="CP">CP:</label>
                <input type="text" class="form-control" id="CP" name="CP" maxlength="11" value="{{ $datos->CP }}">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="11" value="{{ $datos->telefono }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="email1">Email 1:</label>
                <input type="email" class="form-control" id="email1" name="email1" maxlength="100" value="{{ $datos->email1 }}">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="email2">Email 2:</label>
                <input type="email" class="form-control" id="email2" name="email2" maxlength="100" value="{{ $datos->email2 }}">
            </div>
        </div>
    </div>
    
    <hr/>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="TipoContador">Tipo Contador:</label>
                <select class="form-control" id="TipoContador" name="TipoContador">
                    @foreach ($TipoContador as $tipo)
                        <option value="{{ $tipo->idContador }}" @if((int)$datos->TipoContador === $tipo->idContador) selected @endif>{{ $tipo->tipo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="articulos">Utilizar la Base de Datos de Artículos:</label>
                <select class="form-control" id="articulos" name="articulos">
                    <option value="SI" @if($datos->articulos === 'SI') selected @endif>SI</option>
                    <option value="NO" @if($datos->articulos === 'NO') selected @endif>NO</option>
                </select>
            </div>
        </div>
    </div>
    
    <hr/>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="tipo_contador">Logo:</label>
                <input type="file" class="form-control" id="doc" name="doc" onchange="check_fileConsulta(this);" accept="image/png" /><br/>
                <span id="txt_file">El documento debe ser PNG</span><br/>
                <input type="hidden" id="errorFile" name="errorFile" />
                <script>
                function check_fileConsulta(file){
                    var respuesta = true;
                    $.ajax({
                        data:{"file":file.value},  
                        url: '{{ URL::asset("datos/logo") }}',
                        type:"get",
                        success: function(data) {
                            var datos = JSON.parse(data);
                            $('#errorFile').val(datos.estado);
                            $('#txt_file').html(datos.msj);
//                          if(data != ''){
//                              respuesta = false;
//                          }
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
                      <img id="imagen" height="70" width="140" src="{{ URL::asset('images/').'/'.$datos->Logo }}" />
                  </span><br/>
              </div>
            </div>
        </div>
    </div>
    
    <hr/>

    <div class="row">
        <div class="col-md-11">
            <div class="form-group">
                <label for="TextoPie">Texto a pie de página:</label>
                <textarea class="form-control" rows="4" name="TextoPie" id="TextoPie" maxlength="260">{{ $datos->TextoPie }}</textarea>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="TipoIRPF">Retención IRPF (sino tiene escriba NO):</label>
                <input type="text" class="form-control" id="TipoIRPF" name="TipoIRPF" maxlength="5" value="{{ $datos->TipoIRPF }}" required>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="PrefijoFactRectificativas">Prefijo Facturas Abono:</label>
                <input type="text" class="form-control" id="PrefijoFactRectificativas" name="PrefijoFactRectificativas" 
                       maxlength="5" value="{{ $datos->PrefijoFactRectificativas }}" required>
            </div>
        </div>
    </div>
    
    <br/>

    <!--<input type="hidden" id="idCliente" name="idCliente" value="" />-->
    <input type="button" id="submitir" class="btn btn-default" value="Guardar" onclick="submitDatos();" >
</form>

<script>
function submitDatos(){
    ok = "SI";
    if($('#errorFile').val() === "ERROR"){
        ok = "NO";
    }
    
    if(ok === 'SI'){
        document.datosForm.submit();
        //$('#datosForm').submit();
    }else{
        alert('El fichero del Logo ya existe, eliga otro nombre de fichero (recomendación: logo_NombreEmpresa.Extension)');
    }
}
    
$(document).ready(function() {
    $('#datosForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            Nombre: {
                validators: {
                    notEmpty: {
                        message: 'El Nick es obligatorio'
                    }
                }
            },
            Password: {
                validators: {
                    notEmpty: {
                        message: 'El Password es obligatorio'
                    }
                }
            },
            identificacion: {
                validators: {
                    notEmpty: {
                        message: 'El Nombre de Empresa es obligatorio'
                    }
                }
            },
            email1: {
                validators: {
                    notEmpty: {
                        message: 'El Email 1 es obligatorio'
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



