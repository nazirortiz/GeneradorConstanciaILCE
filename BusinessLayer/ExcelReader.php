<?php

    /*
        Autor: Nazir Ortiz
        Descripción:
        Clase para manipular un documento en formato *.xlxs
        Se requiere tener instalado el proyecto PHPExcel https://github.com/PHPOffice/PHPExcel
    */
    class ExcelReader {
        
        public function  __construct() {
        
        }

        public function LeerCertificacion($fileName){

            $datosDocumento = "";
    
            require_once '../Libraries/PHPExcel/Classes/PHPExcel.php';
            $archivo = $fileName;
            $inputFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0); 
            $highestRow = $sheet->getHighestRow(); 
            $highestColumn = $sheet->getHighestColumn();
    
            for ($row = 2; $row <= $highestRow; $row++){ 
                    echo $sheet->getCell("A".$row)->getValue().", ";
                    echo $sheet->getCell("B".$row)->getValue().", ";
                    echo $sheet->getCell("C".$row)->getValue();
                    echo "<br>";
            }
        }

    }

    