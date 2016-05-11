<!--cargar autoresize del campo concepto-->
<script type="text/javascript" src="{{ URL::asset('js/autoresize/textareaAutoResize.js') }}"></script>

<script>
function calculoCantidad(linea){
    //primero compruebo que el valor sea numerico
    var cantidad = $('#Cantidad'+linea).val();
    
    //compruebo si es numerico o no
    if(isNaN(cantidad)){
        //indico que no es numerico y lo borro
        //hace el calculo
        $('#txtCantidad'+linea).css({"display": "block"});
        $('#groupCantidad'+linea).addClass("has-feedback has-error");
        setTimeout(function(){
            $('#Cantidad'+linea).val('');
        },500);
        
        return false;
    }
    
    var precio = $('#Precio'+linea).val();
    var importe = $('#Importe'+linea).val();
    var IVA = $('#IVA'+linea).val();

    //si los tres valores son numericos hacemos calculo    
    if(isNaN(cantidad) || isNaN(precio) || isNaN(importe)){
        //en cuanto uno de ellos no sea numerico nos salimos
    return false;
    }else{
        //calculamos
        calculo(linea,cantidad,precio,IVA);
    }
}

function comprobar(linea){
    var concepto = $('#Concepto'+linea).val();
    
    if(concepto === ''){
        $('#txtConcepto'+linea).css({"display": "block"});
        $('#groupConcepto'+linea).addClass("has-feedback has-error");
        return false;
    }
    return false;
}

function calculoPrecio(linea){
    //primero compruebo que el valor sea numerico
    var precio = $('#Precio'+linea).val();
    
    //compruebo si es numerico o no
    if(isNaN(precio)){
        //indico que no es numerico y lo borro
        //hace el calculo
        $('#txtPrecio'+linea).css({"display": "block"});
        $('#groupPrecio'+linea).addClass("has-feedback has-error");
        setTimeout(function(){
            $('#Precio'+linea).val('');
        },500);
        return false;
    }
    
    var cantidad = $('#Cantidad'+linea).val();
    var importe = $('#Importe'+linea).val();
    var IVA = $('#IVA'+linea).val();

    //si los tres valores son numericos hacemos calculo    
    if(isNaN(cantidad) || isNaN(precio) || isNaN(importe)){
        //en cuanto uno de ellos no sea numerico nos salimos
        return false;
    }else{
        //calculamos
        calculo(linea,cantidad,precio,IVA);
    }
}

function calculoImporte(linea){
    //primero compruebo que el valor sea numerico
    var importe = $('#Importe'+linea).val();
    
    //compruebo si es numerico o no
    if(isNaN(importe) || importe === ''){
        //indico que no es numerico y lo borro
        //hace el calculo
        $('#Importe'+linea).css({"display": "block"});
        $('#Importe'+linea).addClass("has-feedback has-error");
        setTimeout(function(){
            $('#Importe'+linea).val('');
        },1000);
        return false;
    }
    
    var cantidad = $('#Cantidad'+linea).val();
    var precio = $('#Precio'+linea).val();
    var IVA = $('#IVA'+linea).val();

    //si los tres valores son numericos hacemos calculo    
    if(isNaN(cantidad) || isNaN(precio) || isNaN(importe)){
        //en cuanto uno de ellos no sea numerico nos salimos
        return false;
    }else{
        //calculamos
        //compruebo que cantidad * precio = importe
        var nuevoImporte = cantidad * precio;
        if(parseFloat(nuevoImporte).toFixed(2) !== importe){
            //como el importe no concuerda con la cantida*precio, borro estos dos campos
            $('#Cantidad'+linea).val('');
            $('#Precio'+linea).val('');
        }
        
        calculoIVA_Total(linea,importe,IVA);
    }
}

function calculoIVA(linea){
    //primero compruebo que el valor sea numerico
    var importe = $('#Importe'+linea).val();
    var cantidad = $('#Cantidad'+linea).val();
    var precio = $('#Precio'+linea).val();
    var IVA = $('#IVA'+linea).val();

    //si los tres valores son numericos hacemos calculo    
    if(isNaN(cantidad) || isNaN(precio) || isNaN(importe)){
        //en cuanto uno de ellos no sea numerico nos salimos
        return false;
    }else{
        //calculamos
        calculoIVA_Total(linea,importe,IVA);
    }
}

function calculo(linea,cantidad,precio,IVA){
    //importe = cantidad x precio
    var nuevoImporte = cantidad * precio;
    nuevoImporte = parseFloat(nuevoImporte).toFixed(2);
    $('#Importe'+linea).val(nuevoImporte.toString());
    //cuotaIVA = importe x IVA / 100
    var nuevoCuotaIVA = nuevoImporte * IVA / 100;
    nuevoCuotaIVA = parseFloat(nuevoCuotaIVA).toFixed(2);
    $('#Cuota'+linea).val(nuevoCuotaIVA.toString());
    //total = importe + cuotaIVA
    var nuevoTotal = parseFloat(nuevoImporte) + parseFloat(nuevoCuotaIVA);
    nuevoTotal = parseFloat(nuevoTotal).toFixed(2);
    $('#Total'+linea).val(nuevoTotal.toString());
    return true;
}

function calculoIVA_Total(linea,importe,IVA){
    //cuotaIVA = importe x IVA / 100
    var nuevoCuotaIVA = importe * IVA / 100;
    nuevoCuotaIVA = parseFloat(nuevoCuotaIVA).toFixed(2);
    $('#Cuota'+linea).val(nuevoCuotaIVA.toString());
    //total = importe + cuotaIVA
    var nuevoTotal = parseFloat(importe) + parseFloat(nuevoCuotaIVA);
    nuevoTotal = parseFloat(nuevoTotal).toFixed(2);
    $('#Total'+linea).val(nuevoTotal.toString());
    return true;
}

//comprobar que los campos solo sean numericos
function solonumeros(e)
{

//    key = e.keyCode || e.which;
//    tecla = String.fromCharCode(key).toLowerCase();
//    letras = "0123456789";
//    especiales = [8,9,37,39,46];
//
//    tecla_especial = false
//    for(var i in especiales){
//         if(key == especiales[i]){
//             tecla_especial = true;
//             break;
//         }
//     }
//
//     if(letras.indexOf(tecla)==-1 && !tecla_especial){
//         return false;
//     }    
}

//comprobar que los campos solo sean numericos
function solonumerosNeg(e)
{

    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8,9,37,39,45,46];

    tecla_especial = false
    for(var i in especiales){
         if(key == especiales[i]){
             tecla_especial = true;
             break;
         }
     }

     if(letras.indexOf(tecla)==-1 && !tecla_especial){
         return false;
     }    
}

//sumas de los importes, cuotas y totales
function sumasFactura(){
    sumas("facturaForm");
}

function sumasPresupuesto(){
    sumas("presupuestoForm");
}

function sumasPedido(){
    sumas("pedidoForm");
}

function sumas(form){
    
    var importeTotal = 0;
    var cuotaTotal = 0;
    var total = 0;
    
    $('#'+form).find(":input").each(function(){
        var elemento = this;
        //comprobamos el nombre del elemento y lo guardamos en un array segun sea cantidad, precio, importe y concepto
        var nombreElemento = elemento.name;
        if(isNaN(elemento.value) || elemento.value === ''){
        }else{
            if(nombreElemento.substring(0,7) === 'Importe'){//es un elemento importe
                importeTotal = parseFloat(importeTotal) + parseFloat(elemento.value);
            }            
            if(nombreElemento.substring(0,5) === 'Cuota'){//es un elemento cuota
                cuotaTotal = parseFloat(cuotaTotal) + parseFloat(elemento.value);
            }
        }
    });
    
    if(isNaN(importeTotal)){
        
    }
    
    importeTotal = parseFloat(importeTotal).toFixed(2);
    cuotaTotal = parseFloat(cuotaTotal).toFixed(2);
    
    total = parseFloat(importeTotal) + parseFloat(cuotaTotal);
    total = parseFloat(total).toFixed(2);

    //escribo en los campos
    $('#totalImporte').val(importeTotal.toString());
    $('#totalCuota').val(cuotaTotal.toString());
    $('#Total').val(total.toString());

}

function calculoIRPF(){
    var retencionCuota = parseFloat($('#Retencion').val()) / 100 * parseFloat($('#totalImporte').val()); 
    retencionCuota = parseFloat(retencionCuota).toFixed(2);
    $('#RetencionCuota').val(retencionCuota);

    var totalNeto = parseFloat($('#Total').val()) - retencionCuota;
    totalNeto = parseFloat(totalNeto).toFixed(2);
    $('#TotalNeto').val(totalNeto);
        
}

</script>
