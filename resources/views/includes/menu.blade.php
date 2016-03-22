            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuración<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::asset('mis_datos') }}">Mis Datos</a></li>
                  <li><a href="{{ URL::asset('clientes') }}">Clientes</a></li>
                  <li><a href="{{ URL::asset('proveedores') }}">Proveedores</a></li>
                  <li><a href="{{ URL::asset('articulos') }}">Articulos</a></li>
                </ul>            
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Presupuestos<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::asset('mis_datos') }}">Alta</a></li>
                  <li><a href="{{ URL::asset('clientes') }}">Modificación/Duplicar/Borrar</a></li>
                  <li><a href="{{ URL::asset('proveedores') }}">Facturar Presupuesto</a></li>
                </ul>            
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Facturas<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::asset('mis_datos') }}">Alta</a></li>
                  <li><a href="{{ URL::asset('clientes') }}">Modificación/Duplicar/Borrar</a></li>
                  <li><a href="{{ URL::asset('proveedores') }}">Facturar Presupuesto</a></li>
                  <li><a href="{{ URL::asset('cobrar_facturas') }}">Cobrar Facturas</a></li>
                </ul>            
            </li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::asset('logout') }}">Salir</a></li>
