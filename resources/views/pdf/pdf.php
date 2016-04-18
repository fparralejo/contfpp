<?php 
//cargo la libreria FPDF
use Anouar\Fpdf\Fpdf as baseFpdf;
use App\Http\Controllers\adminController;


//defino el objeto PDF
class PDF extends baseFpdf{

    public $datos;
    public $cliente;
    public $presupuesto;
    public $presupuestoDetalle;
    public $numero;
    public $accion;

    //anchos de columnas
    public $columCantidad;
    public $columConcepto;
    public $columPrecio;
    public $columImporte;
    public $columIva;
    public $columCuota;
    public $columTotal;
    
    public $totalImporte;
    public $totalCuota;
    
    public $IRPFCuota;
    public $totalFinal;
    public $fill;

    
    // Cabecera de página
    function Header(){
        $this->Ln(10);
        // Logo
        $this->Image('images/'.$this->datos->Logo,10,22,36,18);//  36/18 proporcional a 140/70 tamaño de la imagen

        // Arial bold 14
        $this->SetFont('Arial','B',14);
        // Movernos a la derecha
        $this->Cell(150);
        // Título
        $this->Cell(30,20,utf8_decode('PRESUPUESTO Nº ').utf8_decode($this->numero),0,0,'R');
        // Salto de línea
        $this->Ln(25);
    }

    
    // Pie de página
    function Footer()
    {
        //cargo adminController (tiene funciones auxiliares)
        $admin = new adminController();

        //por último los subtotales y totales
        // Posición: a 1,5 cm del final
        $Y = -58;
        $this->SetY($Y);
        $altura = 6;

        $this->SetFillColor(240,248,255);
        $this->SetLineWidth(0.1);
        $this->SetFont('Arial','B',9);
        $this->Cell(($this->columCantidad+$this->columConcepto+$this->columPrecio-0.2), $altura, 'Subtotales','LT','L', 'R',true);
        $this->Cell($this->columImporte, $altura, $admin->formateaNumeroContabilidad($this->totalImporte),'T','L', 'R',true);
        $this->Cell(($this->columIva+$this->columCuota), $altura, $admin->formateaNumeroContabilidad($this->totalCuota),'T','L', 'R',true);
        $this->Cell($this->columTotal, $altura, $admin->formateaNumeroContabilidad($this->totalImporte+$this->totalCuota),'TR','L', 'R',true);
        $this->Ln();
        $Y = $Y + 6;
        $this->SetY($Y);
        $this->IRPFCuota = $this->totalImporte * $this->presupuesto->Retencion / 100;
        $this->totalFinal = $this->totalImporte + $this->totalCuota - $this->IRPFCuota;
        if($this->presupuesto->Retencion <> '0'){
            $this->Cell(145-0.2, $altura, utf8_decode('Retención %'),'L','L', 'R',true);
            $this->Cell(15, $altura, $this->presupuesto->Retencion,0,'L', 'R',true);
            $this->Cell(25, $altura, $admin->formateaNumeroContabilidad($this->IRPFCuota),'R','L', 'R',true);
            $this->Ln();
            $Y = $Y + 6;
            $this->SetY($Y);
        }
        $this->Cell(160-0.2, $altura, utf8_decode('TOTAL '),'LB','L', 'R',true);
        $this->Cell(25, $altura, $admin->formateaNumeroContabilidad($this->totalFinal),'BR','L', 'R',true);
        $this->Ln();
        $this->Ln();
        $Y = $Y + 9;
        $this->SetY($Y);
    
        //forma de pago y validez presupuesto
        $this->SetFillColor(232,232,232);
        $this->Cell(25, $altura, 'Forma de Pago:',0,'L', 'R');
        $this->Cell(35, $altura, utf8_decode($this->presupuesto->FormaPago),0,'R', 'L',true);
        $this->Cell(40, $altura, 'Vencimiento:',0,'L', 'R');
        $this->Cell(10, $altura, $this->presupuesto->FechaVtoPresupuesto,0,'R', 'C',true);
        //$this->Cell(10, $altura, utf8_decode('días f.f.'),0,'L', 'L');
        $this->Ln();
//        $this->Cell(25, $altura, '',0,'L', 'R');
//        if($this->presupuesto['FormaPago'] === 'Transferencia'){
//            $this->Cell(35, $altura, utf8_decode($this->datosPresupuesto['CC_Trans']),0,'R', 'L');
//        }
//        $this->Ln();
        
        
        
        
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(120,120,120);
        // Posición: a 1,5 cm del final
        $this->SetY(-25);
        // Arial italic 8
        $this->SetFont('Arial','',8);
        //calculo las palabras que tiene el texto
        $numPalabras = explode(' ',utf8_decode($this->datos->TextoPie));
        
        $textoLinea = '';
        $altura = 0;
        for($i = 0;$i < count($numPalabras);$i++){
            //voy rellenando la linea de palabras
            $textoLinea = $textoLinea . $numPalabras[$i].' ';
            //compruebo que no paso de un limite
            if(strlen($textoLinea) > 125){
                $this->Cell(180, $altura,$textoLinea,0,0,'C',false);
                $textoLinea = '';
                $altura = $altura + 8;
                $this->Ln();
            }
        }
        //imprimo la ultima linea sino esta vacia
        if(strlen($textoLinea) > 0){
            $this->Cell(180, $altura,$textoLinea,0,0,'C',false);
        }

        // Posición: a 1,5 cm del final
        $this->SetY(-18);
        // Arial italic 8
        $this->SetFont('Arial','',9);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
    

    // Una tabla más completa
    function DatosNuestrosYCliente()
    {
        $this->SetFillColor(244,244,244);
        $this->SetDrawColor(200,200,200);
        $altura = 5;

        // Datos nuestros: 1 linea
        $this->SetFont('Arial','B',10);
        $this->Cell(55, $altura, utf8_decode($this->datos->identificacion),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        $this->Ln();
        // Datos nuestros: 2 linea
        $this->Cell(55, $altura, utf8_decode($this->datos->direccion),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 1 linea
        $this->SetFont('Arial','',9);
        $this->Cell(25, $altura, utf8_decode("Att de D./Dña: "),'LT', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->nombre . ' ' . $this->cliente[0]->apellidos),'TR', 0, 'L');
        $this->Ln();
        // Datos nuestros: 3 linea
        $this->Cell(55, $altura, $this->datos->CP.' - '.utf8_decode($this->datos->municipio),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 2 linea
        $this->Cell(25, $altura, "Cliente: ",'L', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->nombreEmpresa),'R', 0, 'L');
        $this->Ln();
        // Datos nuestros: 4 linea
        $this->Cell(55, $altura, utf8_decode($this->datos->provincia),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 3 linea
        $this->Cell(25, $altura, "CIF: ",'L', 0, 'R',true);
        $this->Cell(75, $altura, $this->cliente[0]->CIF,'R', 0, 'L');
        $this->Ln();
        // Datos nuestros: 5 linea
        $this->Cell(55, $altura, 'CIF: '.utf8_decode($this->datos->CIF),0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 4 linea
        $this->Cell(25, $altura, utf8_decode("Dirección: "),'L', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->direccion),'R', 0, 'L');
        $this->Ln();
        // Datos nuestros: 6 linea
        $this->Cell(55, $altura, utf8_decode('Teléfono: ').$this->datos->telefono,0,'L', 'L');
        $this->Cell(30, $altura, ' ',0,0, 0);
        // Datos Cliente: 5 linea
        $this->Cell(25, $altura, utf8_decode("Población: "),'L', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->municipio),'R', 0, 'L');
        $this->Ln();
        // Datos nuestros: vacio
        $this->Cell(85, $altura, ' ',0,0, 0);
        // Datos Cliente: 6 linea
        $this->Cell(25, $altura, "Provincia: ",'LB', 0, 'R',true);
        $this->Cell(75, $altura, utf8_decode($this->cliente[0]->provincia),'BR', 0, 'L');
        $this->Ln();
    }


}        


//llamo al objeto PDF
$pdf = new PDF();

//cargo adminController (tiene funciones auxiliares)
$admin = new adminController();

//decodifico los datos JSON
$pdf->cliente = json_decode($cliente);
$pdf->datos = json_decode($datos);
$pdf->presupuesto = json_decode($presupuesto);
$pdf->presupuestoDetalle = json_decode($presupuestoDetalle);
$pdf->numero = json_decode($numero);
$pdf->accion = json_decode($accion);
//var_dump($pdf->datos);die;

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true,60);
$pdf->SetFont('Arial','',9);
$pdf->DatosNuestrosYCliente();
$pdf->SetDrawColor(0,0,0);
$pdf->Ln();
//$pdf->Cell(180, 4, 'Referencia: '.utf8_decode($pdf->datosPresupuesto['Referencia']));

$fecha = explode('/',date('d/m/Y',strtotime($pdf->presupuesto->FechaPresupuesto)));

//escribir mes en texto
switch ($fecha[1]) {
    case '01':
        $mes='Enero';
        break;
    case '02':
        $mes='Febrero';
        break;
    case '03':
        $mes='Marzo';
        break;
    case '04':
        $mes='Abril';
        break;
    case '05':
        $mes='Mayo';
        break;
    case '06':
        $mes='Junio';
        break;
    case '07':
        $mes='Julio';
        break;
    case '08':
        $mes='Agosto';
        break;
    case '09':
        $mes='Septiembre';
        break;
    case '10':
        $mes='Octubre';
        break;
    case '11':
        $mes='Noviembre';
        break;
    case '12':
        $mes='Diciembre';
        break;
}

$pdf->Cell(180, 4, utf8_decode($pdf->datos->municipio.', '.$fecha[0].' de '.$mes.' de '.$fecha[2]),0, 0, 'L');

$pdf->Ln();
$pdf->Ln();


$pdf->columCantidad=15;
$pdf->columConcepto=75;
$pdf->columPrecio=20;
$pdf->columImporte=20;
$pdf->columIva=10;
$pdf->columCuota=20;
$pdf->columTotal=25;

//Cuadro del presupuesto
//cabecera
$pdf->SetFillColor(240,248,255);
$pdf->SetDrawColor(200,200,200);
$pdf->SetLineWidth(0.1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($pdf->columCantidad+0.1, 6, 'Cantidad','LTBR',0,'R',true);
$pdf->SetLineWidth(0.1);
$pdf->Cell(0.1, 6, '','R',0,'R');
$pdf->SetLineWidth(0.1);
$pdf->Cell($pdf->columConcepto-0.1, 6, '  Concepto','BTR',0,'L',true);
$pdf->SetLineWidth(0.1);
$pdf->Cell(0.1, 6, '','R',0,'R');
$pdf->SetLineWidth(0.1);
$pdf->Cell($pdf->columPrecio-0.1, 6, 'Precio','BTR',0,'R',true);
$pdf->SetLineWidth(0.1);
$pdf->Cell(0.1, 6, '','R',0,'R');
$pdf->SetLineWidth(0.1);
$pdf->Cell($pdf->columImporte-0.1, 6, 'Importe','BTR',0,'R',true);
$pdf->SetLineWidth(0.1);
$pdf->Cell(0.1, 6, '','R',0,'R');
$pdf->SetLineWidth(0.1);
$pdf->Cell($pdf->columIva-0.1, 6, 'IVA','BTR',0,'R',true);
$pdf->SetLineWidth(0.1);
$pdf->Cell(0.1, 6, '','R',0,'R');
$pdf->SetLineWidth(0.1);
$pdf->Cell($pdf->columCuota-0.1, 6, 'Cuota','BTR',0,'R',true);
$pdf->SetLineWidth(0.1);
$pdf->Cell(0.1, 6, '','R',0,'R');
$pdf->SetLineWidth(0.1);
$pdf->Cell($pdf->columTotal-0.2, 6, 'Total','TBR',0,'R',true);
$pdf->Ln();


//las lineas del cuerpo
$altura=6;
$pdf->totalImporte=0;
$pdf->totalCuota=0;
for ($i = 0;$i < count($pdf->presupuestoDetalle);$i++){
    //metemos las palabras que hay en el texto en un array
    $palabras=  explode(' ',utf8_decode($pdf->presupuestoDetalle[$i]->DescripcionProducto));
    //prepararmos un array con las lineas de texto rellenas de palabras que no sobrepasen 40 caracteres
    $linea = '';
    $k = 0;//indice de $palabras
    $lineas = array();
    while($k < count($palabras)){
        $lineaAux = $linea . ' ' . $palabras[$k];
        if(strlen($lineaAux) < 49){
            //es menor de 30 caracteres, se incluye
            $linea = $lineaAux;
        }else{
            //es mayor o igual , no se incluye
            $lineas[] = $linea;
            $linea = $palabras[$k];
        }
        $k++;
    }

    //alternar en sombreados por lineas
    if($i % 2 === 0){
        $pdf->fill = false;
    }else{
        $pdf->fill = true;
    }

    //se guarda las ultimas palabras
    $lineas[]=$linea;
    
    //recorrer lineas
    for($j = 0;$j < count($lineas);$j++){
        $altura2 = 6;
        $pdf->SetFillColor(244,244,244);
        $pdf->SetLineWidth(0.1);
        $pdf->SetFont('Arial','',9);
        if($j === 0){
            if($pdf->presupuestoDetalle[$i]->Cantidad === '0'){
                $pdf->presupuestoDetalle[$i]->Cantidad = '';
            }
            $pdf->Cell($pdf->columCantidad+0.1, $altura, $admin->formateaNumeroContabilidad($pdf->presupuestoDetalle[$i]->Cantidad),'L',0,'R',$pdf->fill);
        }else{
            $pdf->Cell($pdf->columCantidad+0.1, $altura, '','L',0,'R',$pdf->fill);
        }
        $pdf->SetLineWidth(0.1);
        if($j==0){
            $pdf->Cell($pdf->columConcepto, $altura, trim($lineas[$j]) ,'L',0,'L',$pdf->fill);
        }else{
            $pdf->Cell($pdf->columConcepto, $altura, trim($lineas[$j]) ,'L',0,'L',$pdf->fill);
        }
        if($j==0){
            if($pdf->presupuestoDetalle[$i]->ImporteUnidad === '0'){
                $pdf->presupuestoDetalle[$i]->ImporteUnidad = '';
            }
            $pdf->Cell($pdf->columPrecio, $altura, $admin->formateaNumeroContabilidad($pdf->presupuestoDetalle[$i]->ImporteUnidad),'L',0,'R',$pdf->fill);
        }else{
            $pdf->Cell($pdf->columPrecio, $altura,'' ,'L',0,'R',$pdf->fill);
        }
        if($j==0){
            $pdf->Cell($pdf->columImporte, $altura, $admin->formateaNumeroContabilidad($pdf->presupuestoDetalle[$i]->Importe),'L',0,'R',$pdf->fill);
        }else{
            $pdf->Cell($pdf->columImporte, $altura, '','L',0,'R',$pdf->fill);
        }
        if($j==0){
            $pdf->Cell($pdf->columIva, $altura, $pdf->presupuestoDetalle[$i]->TipoIVA." %",'L',0,'R',$pdf->fill);
        }else{
            $pdf->Cell($pdf->columIva, $altura,'' ,'L',0,'R',$pdf->fill);
        }
        if($j==0){
            $pdf->Cell($pdf->columCuota, $altura, $admin->formateaNumeroContabilidad($pdf->presupuestoDetalle[$i]->CuotaIva),'L',0,'R',$pdf->fill);
        }else{
            $pdf->Cell($pdf->columCuota, $altura,'' ,'L',0,'R',$pdf->fill);
        }
        if($j==0){  
            $pdf->Cell($pdf->columTotal-0.2, $altura, $admin->formateaNumeroContabilidad((float)$pdf->presupuestoDetalle[$i]->Importe + (float)$pdf->presupuestoDetalle[$i]->CuotaIva),'L',0,'R',$pdf->fill);//VOY POR AQUI 18/4/2016
            $pdf->SetLineWidth(0.1);
            $pdf->Cell(0.1, 6, '','R',0,'R');
        }else{
            $pdf->Cell($pdf->columTotal-0.2, $altura,'' ,'L',0,'R',$pdf->fill);
            $pdf->SetLineWidth(0.1);
            $pdf->Cell(0.1, 6, '','R',0,'R');
        }
        $pdf->Ln();
    }
    //sumas de importe y cuota
    $pdf->totalImporte = (float)$pdf->totalImporte + (float)$pdf->presupuestoDetalle[$i]->Importe;
    $pdf->totalCuota = (float)$pdf->totalCuota + (float)$pdf->presupuestoDetalle[$i]->CuotaIva;

    
    
}

//linea inferior
$pdf->Cell(185, 0,'','B',0,'R');
$pdf->Ln();




//header('Content-type: application/pdf');

if($pdf->accion === 'ver'){
    //se renderiza el PDF
    $pdf->Output();
}else{
    //se renderiza el PDF y se guarda
    //$pdf->Output("../docEnviados/Presupuesto_".$datos->IdEmpresa.'-'.$pdf->presupuesto->NumPresupuesto.".pdf","F");
    //$pdf->Close();
}
exit;
