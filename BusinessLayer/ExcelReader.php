<?php
include_once (PATH_LB . 'phpexcel/Classes/PHPExcel.php');

/**
 * @author "Nazir Ortiz" <nazir.ortiz@gmail.com>
 * Descripción: Clase para manipular un documento en formato *.xlxs
 * Se requiere tener la biblioteca PHPExcel
 * @link https://github.com/PHPOffice/PHPExcel
 */
class ExcelReader {
    
    private $filename;

    /**
     * Contrucntor
     */
    public function __construct($filename) {
        $this->filename = $filename;
    }

    /**
     * Leer documento excel para obtener los datos de las personas a las que se les generará
     * las contancias
     * $fileName: Ruta del archivo a leer
     * @return: Arreglo con los datos leidos
     */
    public function obtener_registros(){
        
        $registros = array();

        $inputFileType = PHPExcel_IOFactory::identify($this->filename);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($this->filename);
        $sheet = $objPHPExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++){ 
            array_push($registros, (object)array(
                "identificacion" => $sheet->getCell("A" . $row)->getValue(), 
                "nombre_completo" =>  $sheet->getCell("B" . $row)->getValue(),
                "nivel" =>  $sheet->getCell("C" . $row)->getValue(),
                "periodo" =>  $sheet->getCell("D" . $row)->getValue(),
                "fecha_periodo" =>  $sheet->getCell("E" . $row)->getValue(),
                "fecha_expedicion" =>  $sheet->getCell("F" . $row)->getValue(),
                "sede" =>  $sheet->getCell("G" . $row)->getValue()
            ));
        }

        return $registros;
    }

    public function documento_valido(){
        
        $inputFileType = PHPExcel_IOFactory::identify($this->filename);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($this->filename);
        $sheet = $objPHPExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();

        return $highestRow > 1 && $highestColumn = 'G'; 
    }
}

    