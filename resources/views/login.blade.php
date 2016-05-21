<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Contabilidad</title>

        @include('includes.header')


        <meta name="description" content="">
        <meta name="author" content="">
        <style>

            body {
                padding-top: 20px;
                padding-bottom: 40px;

            }

            .login {
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;

            }

            #sha{
                max-width: 340px;
                -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
                -moz-box-shadow:    0px 0px 18px 0px rgba(48, 50, 50, 0.48);
                box-shadow:         0px 0px 18px 0px rgba(48, 50, 50, 0.48);
                border-radius: 6%;
            }
            #avatar{
                width: 96px;
                height: 96px;
                margin: 0px auto 10px;
                display: block;
                border-radius: 50%;
            } 

        </style>

    </head>
    <body>

        <div class="container well" id="sha">
            <div class="row">
                <div class="col-xs-12">
                    <span><center><h3>Contabilidad XYZ</h3></center></span>	
                    <span><center><h5>Módulo Facturación</h5></center></span>	
                    <span><center><h6>Versión 0.20160521</h6></center></span>	
                    <br/>
                </div>
            </div>

            <form role="form" id="loginform" name="loginform" action="{{URL::to('login')}}" method="post">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- ./ csrf token -->
                @if (Session::has('login_errors'))
                <p style='color:#FB1D1D' >{{ Session::get('login_errors') }}</p>
                @endif
                <p>Empresa</p>
                <div class="form-group">
                    <input type="text" maxlength="15" class="form-control" placeholder="Empresa" name="empresa" id="empresa">
                </div>
                <div class="form-group">
                    <input type="password" maxlength="15" class="form-control" placeholder="Clave Empresa" name="passEmpresa" id="passEmpresa">
                </div>
                <hr>
                <p>Usuario</p>
                <div class="form-group">
                    <input type="text" maxlength="15" class="form-control" placeholder="Usuario" name="usuario" id="usuario">
                </div>
                <div class="form-group">
                    <input type="password" maxlength="15" class="form-control" placeholder="Clave Usuario" name="passUsuario" id="passUsuario">
                </div>
                <div class="form-actions clearfix">                      
                    <input class="btn btn-block btn-primary btn-default" value="Acceder" type="submit">
                </div>
                <div class="footer-login">
                    <div class="pull-left text">
                    </div>

                </div>
            </form>
        </div>
        
        
        <!--validaciones-->
        <script>
        $(document).ready(function() {
            $('#loginform').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    empresa: {
                        validators: {
                            notEmpty: {
                                message: 'El nick de empresa es requerido'
                            }
                        }
                    },
                    passEmpresa: {
                        validators: {
                            notEmpty: {
                                message: 'La clave de empresa es requerida'
                            }
                        }
                    },
                    usuario: {
                        validators: {
                            notEmpty: {
                                message: 'El nick de usuario es requerido'
                            }
                        }
                    },
                    passUsuario: {
                        validators: {
                            notEmpty: {
                                message: 'La clave de usuario es requerida'
                            }
                        }
                    }
                }
            });

        });
        </script>



    </body>
</html>