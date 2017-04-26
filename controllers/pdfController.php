<?php

class pdfController extends Controller
{
    private $_pdf;
    
    public function __construct() {
        parent::__construct();
        $this->getLibrary('fpdf');
        $this->_pdf = new FPDF;
        $this->_planilla = $this->loadModel('planilla');
    }
    
    public function index(){}
    
    public function pdf1($nombre, $apellido)
    {
        $this->_pdf->AddPage();
        $this->_pdf->SetFont('Arial','B',16);
        $this->_pdf->Cell(40,10, utf8_decode($nombre . ' ' . $apellido));
        $this->_pdf->Output();
    }
    
    public function pdf2($nombre, $apellido)
    {
        require_once ROOT . 'public' . DS . 'files' . DS . 'pdf2.php';
    }

    public function fuec($id = false)
    {

        if (!isset($id)) {
            $this->redireccionar('planilla');
            exit;
        }

        $planilla = $this->_planilla->getPlanilla($id);
        $licencia = $this->_planilla->getLicencia($id);

        $contrato = '000'.$planilla['contrato'];
        $contratante = $planilla['nombres'].' '.$planilla['apellidos'];
        $cedula_cont = $planilla['cedula'];
        $origen = $planilla['origen'];
        $destino = $planilla['destino'];
        $recorrido = $planilla['recorrido'];
        $fec_inicial = $planilla['fec_inicial'];
        $fec_final = $planilla['fec_final'];
        $modelo = $planilla['modelo'];
        $clase = $planilla['clase'];
        $interno = $planilla['numero'];
        $marca = $planilla['marca'];
        $placa = $planilla['placa'];
        $numero = $planilla['numero'];
        $direccion = $planilla['direccion'];
        $vigencia = $licencia['vigencia'];
        $telefono = $planilla['telefono'];

        $num_licencia = $licencia['licencia'];

        $this->_pdf = new FPDF('p','mm','letter');

        // Creación del objeto de la clase heredada
        $this->_pdf->AliasNbPages();
        $this->_pdf->AddPage();
        $this->_pdf->SetFont('Times','',7.5);
        $this->_pdf->SetTitle ( 'Formato Unico de Extracto de Contrato', false);
        $this->_pdf->SetAutoPageBreak(false,1);  
        
        //Logo
        $this->_pdf->SetXY(15,30);
        $this->_pdf->Image('C:\xampp\htdocs\cp\views\layout\pixelcave\img\logovigilados.jpg',182,257,24);
        $this->_pdf->Image('C:\xampp\htdocs\cp\views\layout\pixelcave\img\mintransp.jpg',15,21,100);
        $this->_pdf->Image('C:\xampp\htdocs\cp\views\layout\pixelcave\img\logo.png',155,21,27);
        
        $this->_pdf->Rect(13, 20, 193,235 );
        $this->_pdf->Rect(13, 20, 123,25 );
        $this->_pdf->Rect(13, 20, 193,25 );
        $this->_pdf->Rect(13, 45, 193,15 );

        $this->_pdf->SetFont('Arial','',10.5);
        $this->_pdf->SetXY(11,47);
        $this->_pdf->MultiCell(200,4,utf8_decode("FORMATO ÚNICO DE EXTRACTO DE CONTRATO DEL SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE \n AUTOMOTOR ESPECIAL \n N° 425007000"),0,'C');

        $this->_pdf->Rect(13, 60, 193,6 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,61);
        $this->_pdf->Cell(45,4,utf8_decode("RAZÓN SOCIAL:"),0,1,'L');
                $this->_pdf->SetFont('Arial','',9);
                $this->_pdf->SetXY(45,61);
                $this->_pdf->Cell(45,4,utf8_decode("COOPERATIVA DE TRANSPORTADORES LLEVA Y TRAE"),0,1,'L');
        $this->_pdf->Rect(13, 60, 150,6 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(164,60.5);
        $this->_pdf->Cell(45,4,utf8_decode("NIT: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',9);
                $this->_pdf->SetXY(172,60.5);
                $this->_pdf->Cell(45,4,utf8_decode("808.456.321-4"),0,1,'L');

        $this->_pdf->Rect(13, 66, 193,5 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,66.5);
        $this->_pdf->Cell(45,4,utf8_decode("CONTRATO N°"),0,1,'L');
                $this->_pdf->SetFont('Arial','',9);
                $this->_pdf->SetXY(43,66.5);
                $this->_pdf->Cell(45,4,utf8_decode("". $contrato),0,1,'L');

        $this->_pdf->Rect(13, 71, 193,7 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,71.5);
        $this->_pdf->Cell(45,4,utf8_decode("CONTRATANTE: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(45,72);
                $this->_pdf->Cell(45,4,utf8_decode("". $contratante),0,1,'L');
        $this->_pdf->Rect(13, 71, 150,7 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(164,71.5);
        $this->_pdf->Cell(45,4,utf8_decode("C.C: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(172,72);
                $this->_pdf->Cell(45,4,utf8_decode("". $cedula_cont),0,1,'L');

        $this->_pdf->Rect(13, 78, 193,5 );
        $this->_pdf->SetFont('Arial','B',9);
        $this->_pdf->SetXY(14,78.5);
        $this->_pdf->Cell(45,4,utf8_decode("OBJETO DEL CONTRATO: "),0,1,'L');
        $this->_pdf->Rect(13, 83, 193,5 );
                $this->_pdf->SetFont('Arial','',9);
                $this->_pdf->SetXY(57,78.2);
                $this->_pdf->Cell(45,4,utf8_decode("Expreso para transportar unica y exlusivamente las personas que asigne el contratante y quienes"),0,1,'L');
                $this->_pdf->SetXY(15,83.2);
                $this->_pdf->Cell(45,4,utf8_decode("están relacionados en el respectivo contrato a la prestación del servicio público de transporte especial."),0,1,'L');

        $this->_pdf->Rect(13, 88, 193,11 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,88.5);
        $this->_pdf->Cell(45,4,utf8_decode("'ORIGEN-DESTINO', RECORRIDO: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',9);
                $this->_pdf->SetXY(20,93);
                $this->_pdf->Cell(45,4,utf8_decode("'".$origen." - ".$destino."', ".$recorrido),0,1,'L');


        $this->_pdf->Rect(13, 99, 193,11 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,99.5);
        $this->_pdf->Cell(45,4,utf8_decode("CONVENIO: "),0,1,'L');
        $this->_pdf->SetXY(54,99.5);
        $this->_pdf->Cell(45,4,utf8_decode("CONSORCIO: "),0,1,'L');
        $this->_pdf->SetXY(94,99.5);
        $this->_pdf->Cell(45,4,utf8_decode("UNION TEMPORAL: "),0,1,'L');
        $this->_pdf->Rect(130, 99, 40,5 );

        $this->_pdf->Rect(13, 110, 193,5 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(85,110.5);
        $this->_pdf->Cell(45,4,utf8_decode("VIGENCIA DEL CONTRATO:"),0,1,'C');

        $this->_pdf->Rect(13, 115, 193,10 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,115.5);
        $this->_pdf->Cell(45,4,utf8_decode("FECHA DE INICIO: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(52,117.6);
                $this->_pdf->Cell(45,4,utf8_decode("". $fec_inicial),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(87, 115, 80,10 );
        $this->_pdf->SetXY(88,115.5);
        $this->_pdf->Cell(45,4,utf8_decode("DIA: "),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(87, 115, 40,10 );
        $this->_pdf->SetXY(128,115.5);
        $this->_pdf->Cell(45,4,utf8_decode("MES: "),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(168,115.5);
        $this->_pdf->Cell(45,4,utf8_decode("AÑO: "),0,1,'L');

        $this->_pdf->Rect(13, 125, 193,10 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,125.5);
        $this->_pdf->Cell(45,4,utf8_decode("FECHA DE VENCIMIENTO: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(62,127.6);
                $this->_pdf->Cell(45,4,utf8_decode("". $fec_final),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(87, 125, 80,10 );
        $this->_pdf->SetXY(88,125.5);
        $this->_pdf->Cell(45,4,utf8_decode("DIA: "),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(87, 125, 40,10 );
        $this->_pdf->SetXY(128,125.5);
        $this->_pdf->Cell(45,4,utf8_decode("MES: "),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(168,125.5);
        $this->_pdf->Cell(45,4,utf8_decode("AÑO: "),0,1,'L');


        $this->_pdf->Rect(13, 135, 193,6 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(85,136.5);
        $this->_pdf->Cell(45,4,utf8_decode("CARACTERÍSTICAS DEL VEHÍCULO:"),0,1,'C');

        $this->_pdf->Rect(13, 141, 193,8 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,141.5);
        $this->_pdf->Cell(45,4,utf8_decode("PLACA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(33,142.7);
                $this->_pdf->Cell(45,4,utf8_decode(""),0,1,'L');

        $this->_pdf->Rect(59, 141, 40,8 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(60,141.5);
        $this->_pdf->Cell(45,4,utf8_decode("MODELO: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(80,142.7);
                $this->_pdf->Cell(45,4,utf8_decode("". $modelo),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(99,141.5);
        $this->_pdf->Cell(45,4,utf8_decode("MARCA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(116,142.7);
                $this->_pdf->Cell(45,4,utf8_decode(""),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(150, 141, 56,8 );
        $this->_pdf->SetXY(150,141.5);
        $this->_pdf->Cell(45,4,utf8_decode("CLASE: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(166,142.7);
                $this->_pdf->Cell(45,4,utf8_decode("". $clase),0,1,'L');
        
        $this->_pdf->Rect(13, 149, 193,8 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,149.5);
        $this->_pdf->Cell(45,4,utf8_decode("NUMERO INTERNO: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(53,150.4);
                $this->_pdf->Cell(45,4,utf8_decode("". $interno),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(79, 149, 127,8 );
        $this->_pdf->SetXY(79,149.5);
        $this->_pdf->Cell(45,4,utf8_decode("NÚMERO DE TARJETA DE OPERACIÓN: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(153,150.4);
                //$this->_pdf->Cell(45,4,utf8_decode("". $tarjeta),0,1,'L');

        $this->_pdf->Rect(13, 157, 193,12 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,158.4);
        $this->_pdf->MultiCell(45,4,utf8_decode("DATOS DEL \nCONDUCTOR 1:"),0,'L');
        $this->_pdf->Rect(47, 157, 72,12 );
        $this->_pdf->SetXY(47,157.5);
        $this->_pdf->Cell(45,4,utf8_decode("NOMBRES Y APELLIDOS: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(52,162.3);
                //$this->_pdf->Cell(45,4,utf8_decode("". $conductor),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(119,157.5);
        $this->_pdf->Cell(45,4,utf8_decode("N° CEDULA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(122,162.3);
                //$this->_pdf->Cell(45,4,utf8_decode("". $cedula),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(148, 157, 30,12 );
        $this->_pdf->SetXY(148,157.5);
        $this->_pdf->Cell(45,4,utf8_decode("N° LICENCIA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(153,162.3);
                $this->_pdf->Cell(45,4,utf8_decode("" .$num_licencia),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(178,157.5);
        $this->_pdf->Cell(45,4,utf8_decode("VIGENCIA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(180,162.3);
                $this->_pdf->Cell(45,4,utf8_decode("". $vigencia),0,1,'L');

        $this->_pdf->Rect(13, 169, 193,12 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,170.4);
        $this->_pdf->MultiCell(45,4,utf8_decode("DATOS DEL \nCONDUCTOR 2:"),0,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(47, 169, 72,12 );
        $this->_pdf->SetXY(47,169.5);
        $this->_pdf->Cell(45,4,utf8_decode("NOMBRES Y APELLIDOS: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(52,174.4);
                //$this->_pdf->Cell(45,4,utf8_decode("". $conductor),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(119,169.5);
        $this->_pdf->Cell(45,4,utf8_decode("N° CEDULA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(122,174.4);
                //$this->_pdf->Cell(45,4,utf8_decode("". $cedula),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(148, 169, 30,12 );
        $this->_pdf->SetXY(148,169.5);
        $this->_pdf->Cell(45,4,utf8_decode("N° LICENCIA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(153,174.4);
                $this->_pdf->Cell(45,4,utf8_decode("" .$licencia),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(178,169.5);
        $this->_pdf->Cell(45,4,utf8_decode("VIGENCIA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(180,174.4);
                $this->_pdf->Cell(45,4,utf8_decode("". $vigencia),0,1,'L');

        $this->_pdf->Rect(13, 181, 193,12 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,182.4);
        $this->_pdf->MultiCell(45,4,utf8_decode("DATOS DEL \nCONDUCTOR 3:"),0,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(47, 181, 72,12 );
        $this->_pdf->SetXY(47,181.5);
        $this->_pdf->Cell(45,4,utf8_decode("NOMBRES Y APELLIDOS: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(52,186.4);
                //$this->_pdf->Cell(45,4,utf8_decode("". $conductor),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(119,181.5);
        $this->_pdf->Cell(45,4,utf8_decode("N° CEDULA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(122,186.4);
                //$this->_pdf->Cell(45,4,utf8_decode("". $cedula),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(148, 181, 30,12 );
        $this->_pdf->SetXY(148,181.5);
        $this->_pdf->Cell(45,4,utf8_decode("N° LICENCIA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(153,186.4);
                $this->_pdf->Cell(45,4,utf8_decode("" .$licencia),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(178,181.5);
        $this->_pdf->Cell(45,4,utf8_decode("VIGENCIA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(180,186.4);
                //$this->_pdf->Cell(45,4,utf8_decode("". $vigencia),0,1,'L');

        $this->_pdf->Rect(13, 193, 193,14 );
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(14,194.4);
        $this->_pdf->MultiCell(45,4,utf8_decode("RESPONSABLE \nDEL CONTRATO:"),0,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(47, 193, 72,14 );
        $this->_pdf->SetXY(47,193.5);
        $this->_pdf->Cell(45,4,utf8_decode("NOMBRES Y APELLIDOS: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(52,199.4);
                $this->_pdf->Cell(45,4,utf8_decode("". $contratante),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(119,193.5);
        $this->_pdf->Cell(45,4,utf8_decode("N° CEDULA: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(122,199.4);
                $this->_pdf->Cell(45,4,utf8_decode("". $cedula_cont),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->Rect(148, 193, 30,14 );
        $this->_pdf->SetXY(148,193.5);
        $this->_pdf->Cell(45,4,utf8_decode("TELÉFONO: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(153,199.4);
                $this->_pdf->Cell(45,4,utf8_decode("" .$telefono),0,1,'L');
        $this->_pdf->SetFont('Arial','B',10);
        $this->_pdf->SetXY(178,193.5);
        $this->_pdf->Cell(45,4,utf8_decode("DIRECCIÓN: "),0,1,'L');
                $this->_pdf->SetFont('Arial','',10);
                $this->_pdf->SetXY(180,199.4);
                $this->_pdf->Cell(45,4,utf8_decode("". $direccion),0,1,'L');

        $this->_pdf->Rect(13, 207, 193,48 );        
        $this->_pdf->Rect(13, 207, 106,48 );

        $this->_pdf->SetFont('Arial','',10.5);
        $this->_pdf->SetXY(11,214);
        $this->_pdf->MultiCell(110,5,utf8_decode("Calle 4 No.3-45 \nFusagasugá- Cundinamarca \n info@llevaytrae.com \nCEL: 3122577271- 3213232245 \n SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE \nAUTOMOTOR ESPECIAL"),0,'C');

        $this->_pdf->Line(130,240, 195,240);
        $this->_pdf->SetFont('Arial','',9.5);
        $this->_pdf->SetXY(130,242);
        $this->_pdf->Cell(70,4,utf8_decode("REPRESENTANTE LEGAL"),0,1,'C');

    $this->_pdf->Output();
    }

    //CONTRATO
    public function contrato($id = false)
    {

        if (!isset($id)) {
            $this->redireccionar('planilla/nuevo');
            exit;
        }

        $this->_pdf = new FPDF('p','mm','legal');

        // Creación del objeto de la clase heredada
        $this->_pdf->AliasNbPages();
        $this->_pdf->AddPage();
        $this->_pdf->SetFont('Times','',7.5);
        $this->_pdf->SetTitle ( 'Contrato', false);
        $this->_pdf->SetAutoPageBreak(false,1);  
        
        //Logo
        $this->_pdf->SetXY(15,30);
        $this->_pdf->Image('C:\xampp\htdocs\cp\views\layout\pixelcave\img\logovigilados.jpg',15,15,35);
        $this->_pdf->Image('C:\xampp\htdocs\cp\views\layout\pixelcave\img\logo.png',175,7,27);

        $this->_pdf->SetFont('Arial','',9.5);
        $this->_pdf->SetXY(11,10);
        $this->_pdf->MultiCell(200,4.5,utf8_decode("COOPERATIVA DE TRANSPORTE LLEVA Y TRAE \nNIT 808.456.321-4

            CONTRATO DE TRANSPORTE DE PASAJEROS \nEN EL SERVICIO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL "),0,'C');
        $this->_pdf->SetFont('Arial','',11);
        $this->_pdf->SetXY(85,33);
        $this->_pdf->Cell(45,4,utf8_decode("N° 43544343"),0,1,'C');
        
        $this->_pdf->SetFont('Arial','',8);
        $this->_pdf->SetXY(11,40);
        $this->_pdf->MultiCell(193,4,utf8_decode("LA COOPERATIVA DE TRANSPORTADORES LLEVA Y TRAE, con domicilio principal en la Calle 4 No.3- 45  Fusagasugá (Cundinamarca), identificada con NIT.No.808.456.321-4, y quien para el presente contrato y para sus efectos se denominará EL CONTRATISTA, y xx con cedula de ciudadanía No. xx, quien actúa en representación del grupo específico de usuarios, con domicilio en la municipalidad de xxx quien en el presente contrato se denominará CONTRATANTE y se regirá por las siguientes clausulas:
            
PRIMERA- OBJETO DEL CONTRATO- El contratista se compromete a prestar el servicio de TRANSPORTE ESPECIAL de conformidad con la solicitud del CONTRATANTE, a las siguientes personas:
        1. 
        2. 
        3. 
        4. 
En el vehículo distinguido con las siguientes características:

Tipo:     Placa:    Marca:    Modelo:      No. Tarjeta de Operación: 

en concordancia con las disposiciones que para tal efecto, reglamenten las autoridades de transito y transporte.

SEGUNDA- EL CONTRATISTA se compromete a mantener en buen estado de funcionamiento, presentación y limpieza, el vehículo que destine para el cumplimiento del presente contrato  y contar con conductores, con el lleno de todos los requisitos que indiquen las autoridades competentes.

TERCERA- Todos los vehículos que EL CONTRATISTA vincula al presente contrato deben poseer los siguientes documentos y elementos de seguridad: La licencia de transito, tarjeta de operación, revisión técnico mecánica, seguro obligatorio de daños corporales, seguro de responsabilidad civil contra actual y extracontractual que señala la ley.

CUARTA- El contratista ofrecerá conductores en impecable estado de presentación, en la ejecución del contrato.

QUINTA- Serán de cuenta y riesgo a cargo del CONTRATISTA todas las multas o sanciones por concepto de ordenes de los comparendos en infracciones tanto de transporte como en tránsito, tales como violaciones al CODIGO NACIONAL DE TRANSITO TERRESTRE AUTOMOTOR Y ESTATUTOS DE TRANSPORTE TERRESTRE AUTOMOTOR DE PASAJEROS ESPECIALES.

SEXTA- EL CONTRATISTA suministrará  al CONTRATANTE cuando estos lo dispongan los documentos, fotocopias auténticas de las pólizas de seguros o documentos incorporados al presente contrato.

SEPTIMA- EL CONTRATISTA nombrará un COORDINADOR DE RUTAS, que será el encargado de atender los aspectos operativos en la ejecución del presente contrato.
            
OCTAVA- El CONTRATISTA se compromete a servir los siguientes recorridos viales, señalados por el CONTRATANTE en las siguientes rutas, enumeradas así: recogiéndolo en la ciudad de para llevar a la ciudad de xxxxx realizando el siguiente recorrido:

        PARÁGRAFO 1:  Estas rutas o recorridos podrán variarse de común acuerdo a la solicitud de EL CONTRATANTE.

NOVENA.- La prolongación de cualquiera de las rutas pactadas en el presente contrato, ocasionará un ajuste en el precio que será convenido entre las partes de común acuerdo.  

DECIMA: El valor del contrato será de $
            
DECIMA PRIMERA: El incumplimiento por parte del CONTRATISTA en la prestación del servicio de cada recorrido representará una multa igual o equivalente al quince 15 por ciento (%) del valor total del contrato.
            
        PARÁGRAFO: Si el vehículo inicia el recorrido y se vara por fallas mecánicas, accidentes de transito, el CONTRATISTA debe sustituir el vehículo por otro en óptimas condiciones, en este caso se considera como fuerza mayor o caso fortuito imputado al CONTRATISTA.
            
DECIMO SEGUNDA: Si se presentan alteraciones de orden público como paros, o conmoción urbana, los días dejados de laborar o prestar el servicio contratado, si llegare a ocurrir, se descontaran del valor pactado sin que implique dar lugar a terminación de contrato.
            
DECIMA TERCERA: El contratista se compromete a efectuar cambio de conductor inmediato, cuando se presenten deficiencias en la prestación del servicio debido a la falta de atención y cultura hacia el personal que hace parte al grupo específico de usuarios. 
            
DECIMA CUARTA: EL CONTRATISTA se compromete que por ningún motivo el conductor del vehículo, transporte personal ajeno al autorizado por el CONTRATANTE.
            
DECIMA QUINTA: El conductor del vehículo únicamente podrá permitir el acceso a los vehículos cuando se encuentren debidamente parqueados para hacerlo.
        
DECIMASEXTA: Este contrato se celebra para inicial xx y tendrá vigencia hasta el día xx
            
DECIMA SEPTIMA: El incumplimiento de alguna de las cláusulas  del contrato dará lugar, si es el caso, a la terminación del contrato.  
            
 El presente contrato se firma en la ciudad Fusagasugá del día xx     
 "),0,'J'); 

        $this->_pdf->Line(23,338, 88,338);
        $this->_pdf->Line(130,338, 195,338);
        $this->_pdf->SetFont('Arial','',9);
        $this->_pdf->SetXY(28,340);
        $this->_pdf->MultiCell(200,4.5,utf8_decode("CONTRATISTA \nNIT 808.456.321-4"),0,'L');
        $this->_pdf->SetXY(135,340);
        $this->_pdf->MultiCell(200,4.5,utf8_decode("CONTRATANTE \nC.C "),0,'L');
        

    $this->_pdf->Output();
    }
}

?>
