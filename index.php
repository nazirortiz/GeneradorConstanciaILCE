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
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">ILCE - Generador de constancias</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
            </div>
        </nav>
        <main role="main" class="container">
            <?php
                if (isset($_POST["btnGenerarConstancias"])){
                    
                }
            ?>
            <h1>Generación de constancias</h1>
            <br /><br />
            <form id="form" method="post">
                <div class="form-group row">
                    <label for="exampleFormControlFile1" class="col-sm-3 col-form-label">Archivo de Excel</label>
                    <div class="col-sm-8">
                        <input id="exampleFormControlFile1" type="file" class="form-control-file">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlTextarea1" class="col-sm-3 col-form-label">Mensaje de acreditación</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-11 text-right">
                        <button id="btnGenerarConstancias" type="submit" class="btn btn-success">Generar constancias con código QR</button>
                    </div>
                </div>
            </form>
        </main><!-- /.container -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>