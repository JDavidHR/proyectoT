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
                //respectiva consulta para los select
        $id_grupo = $_GET['id_grupo'];
        //respectiva consulta para los select
        $selecciongrupo = $mysql->efectuarConsulta("SELECT asistencia.grupo.nombre as nombre_grupo, asistencia.grupo.Estudiante_id_estudiante, asistencia.estudiante.nombres from grupo join asistencia.estudiante on asistencia.grupo.Estudiante_id_estudiante = asistencia.estudiante.id_estudiante where asistencia.grupo.id_grupo = ".$id_grupo."");

        $selecciongrupo2 = $mysql->efectuarConsulta("SELECT asistencia.grupo.id_grupo, asistencia.grupo.nombre from grupo where estado = 1 GROUP by asistencia.grupo.id_grupo");
        $seleccionEstudiante = $mysql->efectuarConsulta("SELECT asistencia.estudiante.id_estudiante, asistencia.estudiante.nombres from estudiante where asistencia.estudiante.estado = 1");

        while ($valores1 = mysqli_fetch_assoc($selecciongrupo)) {
        //declaracion de variables
            $nombre_grupo = $valores1['nombre_grupo'];
            $idestudiante = $valores1['Estudiante_id_estudiante'];
            $estudiante = $valores1['nombres'];

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
                        <div class="col-6">
                            <div class="container col-md-10" style="text-align: center">
                                <form id="contact" action="Controlador/update_grupo.php?id=<?php echo $id_grupo; ?>" method="post">
                                    <h3>Modificar Grupo</h3>
                                    <h4>Recuerda rellenar el campo</h4>
                                    <div class="form-group row" align="Left">
                                      <label class="col-sm-3 col-form-label">Id del grupo</label>
                                      <div class="col-sm-9">
                                        <input placeholder="Id del horario" class="form-control" type="text" disabled="" name="id" id="inputText" value="<?php echo $id_grupo ?>">
                                      </div>
                                    </div>

                                    <div class="form-group row" align="Left">
                                      <label class="col-sm-3 col-form-label">Nombre del grupo</label>
                                      <div class="col-sm-9">
                                        <input placeholder="..." class="form-control" type="text" name="nombre_grupo" id="inputText" value="<?php echo $nombre_grupo ?>">
                                      </div>
                                    </div>

                                    <fieldset>
                                      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-3">Actualizar</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="container col-md-10" style="text-align: center">
                                <form id="contact" action="#">
                                    <h2 align="center">Datos para tener en cuenta: </h2>
                                    <label align="left">Tenga en cuenta los siguientes datos al momento de cambiar el nombre del grupo.</label>
                                    <label align="left">(Debe escribir los mismos datos en el campo para que el cambio se aplique correctamente.)</label>
                                    <br><br>
                                        <fieldset>
                                            <label>Id del grupo y nombre disponibles: </label>
                                            <center>
                                                <select name="gruposdisponibles" class="form-select">
                                                    <option value="0" disabled="">Seleccione:</option>
                                                    <?php
                                                    //se hace el recorrido de la consulta establecida en la parte superior para mostrar los datos en el respectivo select
                                                    while ($resultado = mysqli_fetch_assoc($selecciongrupo2)) {
                                                    ?>
                                                      <!--se traen los datos a mostrar en el select-->
                                                      <option value="<?php echo $resultado['id_grupo'] ?>"><?php echo $resultado['id_grupo']. " - Nombre: " . $resultado['nombre']?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </center>
                                        </fieldset>
                                </form>
                            </div>
                        </div>
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