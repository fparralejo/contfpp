<script>
function calculoCantidad(linea){
    //primero compruebo que el valor sea numerico
    var cantidad = $('#Cantidad'+linea).val();
    
    //compruebo si es numerico o no
    if(isNaN(cantidad)){
        //indico que no es numerico y lo borro
        //hace el calculo
        alert('Este campo no es numerico');
        setTimeout(function(){
            $('#Cantidad'+linea).val('');
        },1000);
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

//comprobar que los campos solo sean numericos
function solonumeros(e)
{

    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8,9,37,39,46];

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


</script>
