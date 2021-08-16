<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge" />-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistema acad&eacute;mico</title>
    <link href="css/style2.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/registro.css" rel="stylesheet" media="all">
    <link href="css/style.min.css" rel="stylesheet">
    <script src="js/all.min.js" rel="stylesheet"></script>

    
</head>

<body class="sb-nav-fixed">
    <div id="container">
        <?php
        //sesion iniciada
        session_start();
        if (isset($_SESSION['tipousuario'])) {
            //se llama a la plantilla header_index
            include("header_index.php");
        ?>
    </div>
    <?php
            //Llamar al archivo MySQL
            require_once 'Modelo/MySQL.php';
            //Nuevo archivo MySql
            $mysql = new MySQL;
            //Conectar a la base de datos
            $mysql->conectar();
            if (isset($_SESSION['idAdministrador'])) {
                //respectiva consulta para la seleccion de usuario
                $id_aula = $_GET['id_aula'];
                $mostrardatos =$mysql->efectuarConsulta("SELECT asistencia.aula.nombre from aula WHERE asistencia.aula.id_aula = ".$id_aula."");
    //se inicia el recorrido para mostrar los datos de la BD
     while ($valores1 = mysqli_fetch_assoc($mostrardatos)) {
    //declaracion de variables
    $aula = $valores1['nombre'];

        }
            }
        }
        $mysql->desconectar();
        //Si el usuario es un estudiante
        if ($_SESSION['tipousuario'] == 3) {
    ?>
    <br>
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <!--Informacion de la clase seleccionada en el formulario anterior-->
                        <center>
                        
                            <div class="col-md-6 col-md-offset-3">
                            
                            <form id="contact" action="Controlador/administrador/update_aula.php?id=<?php echo $id_aula; ?>" method="post">
                            <b>
                                <p >Actualizar Aula</p>
                            </b>    
                            <div class="form-group row" align="Left">
                                          <label class="col-sm-3 col-form-label">Id del aula</label>
                                          <div class="col-sm-9">
                                            <input placeholder="ID Aula" disabled="" class="form-control" type="text" name="id" id="inputText" value="<?php echo $id_aula ?>">
                                          </div>
                                        </div>

                                        <div class="form-group row" align="Left">
                                          <label class="col-sm-3 col-form-label">Nombre</label>
                                          <div class="col-sm-9">
                                            <input placeholder="Nombre del Aula" class="form-control" type="text" name="nombre_aula" id="inputText" value="<?php echo $aula ?>">
                                          </div>
                                        </div>

    								    <fieldset>
                                          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-3">Actualizar</button>
                                        </fieldset>
                                </form>
                                </div>
                        </center>
                    </div>
                    
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Asistencia estudiantil</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php

    ?>

    <!-- En caso de que no haya una sesion, se redirige al login-->
<?php
        } else {
            header("refresh:0;url=login.php");
        }
?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>

</html>