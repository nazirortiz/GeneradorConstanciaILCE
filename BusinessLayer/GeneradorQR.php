<?php
include_once (PATH_LB . 'phpqrcode/qrlib.php');  
/**
 * @author "Nazir Ortiz" <nazir.ortiz@gmail.com>
 * Descripción: Clase para generar los codigos QR en formato PDF
 * Se requiere tener la biblioteca PHPQRCode
 * @link https://sourceforge.net/projects/phpqrcode/files/
 */
class GeneradorQR{

    private $identificacion;
    private $mensaje_acreditacion;

    /**
     * Constructor
     */
    public function __construct($identificacion, $mensaje_acreditacion){
        $this->identificacion = $identificacion;
        $this->mensaje_acreditacion = $mensaje_acreditacion;
    }

    public function generar_qr(){
        /**
         * Creamos el directorio donde se generarán las registros, el nombre del directorio
         * es creado a partir de la fecha actual
         */
        $ruta_qr = PATH_QR . "/" . date("d-m-Y");

        /**
         * Si no existe la carpeta la creamos en donde se guardarán los codigo QR
         */
        if (!file_exists($ruta_qr)){
            mkdir($ruta_qr);
        }

        /**
         * Parametros de configuración
         */
        // Tamaño de Pixel
        $tamaño = 10; 
        // Precisión Baja
        $level = 'H'; 
        // Tamaño en blanco
        $framSize = 1; 

        $filename = $ruta_qr . "/" . $this->identificacion . ".png";

        // Texto en el QR
        $contenido = $this->identificacion . " " . $this->mensaje_acreditacion;

        // Enviamos los parametros a la Función para generar código QR 
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize);         
    }
}