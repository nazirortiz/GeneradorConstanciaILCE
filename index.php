<?php
    include_once 'Config.php';
    include_once  PATH_BL . 'ExcelReader.php';
    include_once  PATH_BL . 'GeneradorConstancia.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ILCE - Generador de constancias</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            body{
                margin-top: 100px;
                margin-bottom: 50px;
            }
            .error {
                color: red;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="index.php">ILCE - Generador de constancias</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
            </div>
        </nav> 
        <main role="main" class="container">
            <h1>Generación de constancias</h1>
            <br /><br />
            <form id="form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="form-group row">
                    <label for="archivo" class="col-sm-3 col-form-label">Archivo de Excel</label>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input id="archivo" name="archivo" type="file" class="custom-file-input" required>
                            <label class="custom-file-label" for="archivo">Selecciona</label>
                            <div class="invalid-feedback">Selecciona un archivo en formato .xlsx</div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlTextarea1" class="col-sm-3 col-form-label">Mensaje de acreditación</label>
                    <div class="col-sm-8">
                        <textarea id="mensaje" name="mensaje" class="form-control" rows="5" maxlength="500"></textarea>
                        <!-- <div class="invalid-feedback">Ingresa un mensaje de acreditación</div> -->
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-11 text-right">
                        <button id="btnGenerarConstancias" name="btnGenerarConstancias" type="submit" class="btn btn-success">Generar constancias con código QR</button>
                    </div>
                </div>
            </form>
            <?php

                $correcto = true;

                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    /**
                     * Realizamos las validaciones básicas
                     */
                    if (isset($_POST["mensaje"]) && strlen($_POST["mensaje"]) > 500){
                        echo "<span class='error'>El mensaje de acreditación puede tener un máximo de 500 caracteres</span>" . "<br>";
                        $correcto = false;
                    }

                    if (!isset($_FILES['archivo']['error'])){
                        echo "<span class='error'>Debes seleccionar un archivo en formato xlsx</span>" . "<br>";
                        $correcto = false;
                    }
                    else
                    {
                        $ext = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
                        
                        if ($ext !== 'xls' && $ext !== 'xlsx') {
                            echo "<span class='error'>El documento debe tener un formato xls o xlsx</span>" . "<br>";
                            $correcto = false;
                        }
                    }

                    if ($correcto) {

                        /**
                         * $filename: Donde guardaremos el documento Excel que seleccionaron
                         */
                        $filename = PATH_CERTIFICACIONES . $_FILES['archivo']['name'];

                        /**
                         * Guardamos el archivo de las certificaciones (.xlxs) en la carpeta de certificaciones
                         */
                        move_uploaded_file($_FILES['archivo']['tmp_name'], $filename);
                    
                        /**
                         * Validamos que el documento al menos tenga un registro y tenga las columnas completas
                         */
                        $excelReader = new ExcelReader($filename);

                        if ($excelReader->documento_valido()){
                            $registros = $excelReader->obtener_registros();
                            foreach ($registros as $registro){
                                $generadorConstancias = new GeneradorConstancia($registro, $_POST["mensaje"]);
                                $generadorConstancias->generar_constancia();
                            }
                            echo "<script>alert('Las constancias fueron generadas correctamente');window.location.href = 'index.php';</script>";
                        }
                        else{
                            echo "<span class='error'>El documento no tiene las filas o las columnas necesarias</span" . "<br>";
                        }
                    }
                }
            ?>
        </main><!-- /.container -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script>
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </body>
</html>