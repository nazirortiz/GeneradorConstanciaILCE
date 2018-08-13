<?php
include_once (PATH_LB . 'fpdf/fpdftools.php');
include_once (PATH_LB . 'fpdf/fpdf.php');
include_once (PATH_BL . 'GeneradorQR.php');
/**
 * @author "Nazir Ortiz" <nazir.ortiz@gmail.com>
 * Descripción: Clase para generar las registros en formato PDF
 * Se requiere tener la biblioteca FPDF
 * @link http://www.fpdf.org/
 */
class GeneradorConstancia{

    private $registro;
    private $mensaje_acreditacion;

    public function __construct($registro, $mensaje_acreditacion){
        $this->registro = $registro;

        if ($mensaje_acreditacion === ''){
            $this->mensaje_acreditacion = "Por haber acreditado los conocimientos y competencias correspondientes al Nivel " . $registro->nivel . " del programa SEPA Inglés en el " . $registro->periodo . " Ordinario, impartido del " . $registro->fecha_periodo . ".";
        }
        else{
            $this->mensaje_acreditacion = $mensaje_acreditacion;
        }        
    }

    public function generar_constancia(){
        /**
         * Creamos el directorio donde se generarán las registros, el nombre del directorio
         * es creado a partir de la fecha actual
         */
        $ruta_qr = PATH_QR . "/" . date("d-m-Y");
        /**
         * Creamos el directorio donde se generarán las constancias, el nombre del directorio
         * es creado a partir de la fecha actual
         */
        $ruta_constancias = PATH_CONSTANCIAS . "/" .date("d-m-Y");
        
        /**
         * Si no existe la carpeta, la creamos
         */
        if (!file_exists($ruta_constancias)){
            mkdir($ruta_constancias);
        }

        /**
         * Generamos los codigos QR con los identificadores obtenidos
         */
        $generadorQR = new GeneradorQR($this->registro->identificacion, $this->mensaje_acreditacion);
        $generadorQR->generar_qr();

        $pdf = new Fpdftools();

        $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');

        $pdf->AliasNbPages();
        $pdf->SetMargins(0, 0, 0);
        $pdf->AddPage('L', 'Letter');
        $pdf->Image(PATH_RS . 'imagenes/background.jpg', 10, 10, 260, 195);
        
        $pdf->SetTextColor(0, 99, 168);
        $pdf->SetFont('Arial', 'B', 26);

        $pdf->SetXY(70, 134.5);
        $pdf->Cell(5, 0, utf8_decode($this->registro->nombre_completo));
        
        $pdf->SetTextColor(39, 39, 42);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(61, 140);
        $pdf->MultiCell(145, 5, utf8_decode($this->mensaje_acreditacion), 0, 'L');

        $pdf->SetXY(61, 165);
        $pdf->Cell(5, 0, utf8_decode($this->registro->fecha_expedicion));

        $pdf->SetTextColor(128, 128, 128);
        $pdf->SetFont('Montserrat-Bold', '', 12);
        $pdf->SetXY(61, 190);
        $pdf->Cell(5, 0, utf8_decode("Lic. Patricia Cabrera Muñoz"));

        $pdf->SetTextColor(37, 121, 26);
        $pdf->SetFont('Montserrat-Regular', '', 12);
        $pdf->SetXY(61, 195);
        $pdf->Cell(5, 0, utf8_decode("Jefa de la Unidad de Proyectos Educativos"));

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->SetXY(236, 162);
        $pdf->Cell(5, 0, utf8_decode($this->registro->identificacion));

        // Codigo generado en QR
        $pdf->Image($ruta_qr . '/' . $this->registro->identificacion . '.png', 231, 166, 30, 30);

        //$pdf->Output();
        $pdf->Output($ruta_constancias . "/" . $this->registro->identificacion . ".pdf",'F');
    }
}