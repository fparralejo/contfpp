<?php 
//cargo la libreria FPDF
use Anouar\Fpdf\Fpdf as baseFpdf;


//defino el objeto PDF
class PDF extends baseFpdf{

    public $datos;
    public $cliente;
    public $presupuesto;
    public $presupuestoDetalle;
    public $numero;


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

        //por último los subtotales y totales
        // Posición: a 1,5 cm del final
    //    $Y = -58;
    //    $this->SetY($Y);
    //    $altura = 6;

    //    $this->SetFillColor(240,248,255);
    //    $this->SetLineWidth(0.1);
    //    $this->SetFont('Arial','B',9);
    //    $this->Cell(($this->columCantidad+$this->columConcepto+$this->columPrecio-0.2), $altura, 'Subtotales','LT','L', 'R',true);
    //    $this->Cell($this->columImporte, $altura, formateaNumeroContabilidad($this->totalImporte),'T','L', 'R',true);
    //    $this->Cell(($this->columIva+$this->columCuota), $altura, formateaNumeroContabilidad($this->totalCuota),'T','L', 'R',true);
    //    $this->Cell($this->columTotal, $altura, formateaNumeroContabilidad($this->totalImporte+$this->totalCuota),'TR','L', 'R',true);
    //    $this->Ln();
    //    $Y = $Y + 6;
    //    $this->SetY($Y);
    //    $this->IRPFCuota=$this->totalImporte*$this->datosPresupuesto['Retencion']/100;
    //    $this->totalFinal=$this->totalImporte+$this->totalCuota-$this->IRPFCuota;
    //    if($this->datosPresupuesto['Retencion']<>'0'){
    //        $this->Cell(145-0.2, $altura, utf8_decode('Retención %'),'L','L', 'R',true);
    //        $this->Cell(15, $altura, $this->datosPresupuesto['Retencion'],0,'L', 'R',true);
    //        $this->Cell(25, $altura, formateaNumeroContabilidad($this->IRPFCuota),'R','L', 'R',true);
    //        $this->Ln();
    //        $Y = $Y + 6;
    //        $this->SetY($Y);
    //    }
    //    $this->Cell(160-0.2, $altura, utf8_decode('TOTAL '),'LB','L', 'R',true);
    //    $this->Cell(25, $altura, formateaNumeroContabilidad($this->totalFinal),'BR','L', 'R',true);
    //    $this->Ln();
    //    $this->Ln();
    //    $Y = $Y + 9;
    //    $this->SetY($Y);
    //
    //    //forma de pago y validez presupuesto
    //    $this->SetFillColor(232,232,232);
    //    $this->Cell(25, $altura, 'Forma de Pago:',0,'L', 'R');
    //    $this->Cell(35, $altura, utf8_decode($this->datosPresupuesto['FormaPago']),0,'R', 'L',true);
    //    $this->Cell(40, $altura, 'Vencimiento:',0,'L', 'R');
    //    $this->Cell(10, $altura, $this->datosPresupuesto['Validez'],0,'R', 'C',true);
    //    $this->Cell(10, $altura, utf8_decode('días f.f.'),0,'L', 'L');
    //    $this->Ln();
    //    $this->Cell(25, $altura, '',0,'L', 'R');
    //    if($this->datosPresupuesto['FormaPago'] === 'Transferencia'){
    //        $this->Cell(35, $altura, utf8_decode($this->datosPresupuesto['CC_Trans']),0,'R', 'L');
    //    }
    //    $this->Ln();
    //    
    //    
    //    
    //    
    //    $this->SetFillColor(255,255,255);
    //    $this->SetTextColor(120,120,120);
    //    // Posición: a 1,5 cm del final
    //    $this->SetY(-25);
    //    // Arial italic 8
    //    $this->SetFont('Arial','',8);
    //    //calculo las palabras que tiene el texto
    //    $numPalabras=explode(' ',utf8_decode($this->datosPresupuesto['TxtPie']));
    //    
    //    $textoLinea='';
    //    $altura=0;
    //    for($i=0;$i<count($numPalabras);$i++){
    //        //voy rellenando la linea de palabras
    //        $textoLinea=$textoLinea.$numPalabras[$i].' ';
    //        //compruebo que no paso de un limite
    //        if(strlen($textoLinea)>125){
    //            $this->Cell(180, $altura,$textoLinea,0,0,'C',false);
    //            $textoLinea='';
    //            $altura=$altura+8;
    //            $this->Ln();
    //        }
    //    }
    //    //imprimo la ultima linea sino esta vacia
    //    if(strlen($textoLinea)>0){
    //        $this->Cell(180, $altura,$textoLinea,0,0,'C',false);
    //    }

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

//decodifico los datos JSON
$pdf->cliente = json_decode($cliente);
$pdf->datos = json_decode($datos);
$pdf->presupuesto = json_decode($presupuesto);
$pdf->presupuestoDetalle = json_decode($presupuestoDetalle);
$pdf->numero = json_decode($numero);
//var_dump($pdf->cliente);die;

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true,60);
$pdf->SetFont('Arial','',9);
$pdf->DatosNuestrosYCliente();
$pdf->SetDrawColor(0,0,0);
$pdf->Ln();
//$pdf->Cell(180, 4, 'Referencia: '.utf8_decode($pdf->datosPresupuesto['Referencia']));
$pdf->Ln();
$pdf->Ln();



//header('Content-type: application/pdf');

$pdf->Output();
exit;
