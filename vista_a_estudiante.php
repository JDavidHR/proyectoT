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
            $id_estudiante = $_SESSION['idEstudiante'];
            $clase = $_GET['ida_estudiante'];
            //respectiva consulta para la seleccion de usuario
            $datosestudiante = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, estudiante.documento, estudiante.nombres, estudiante.apellidos, estudiante.Carrera_id_carrera, estudiante.semestre, carrera.id_carrera, carrera.nombre from estudiante join carrera on estudiante.Carrera_id_carrera = carrera.id_carrera where estudiante.id_estudiante = " . $id_estudiante . "");
            while ($valores1 = mysqli_fetch_assoc($datosestudiante)) {
                $documento = $valores1['documento'];
                $nombres = $valores1['nombres'];
                $apellidos = $valores1['apellidos'];
                $carrera = $valores1['nombre'];
                $semestre = $valores1['semestre'];
            }

            //consultas para la informacion de la clase
            $MostrarDatos = $mysql->efectuarConsulta("SELECT asistencia.a_estudiante.ida_estudiante, asistencia.a_estudiante.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre as nombremateria, asistencia.grupo.id_grupo, asistencia.grupo.nombre as nombregrupo, asistencia.a_estudiante.fecha, asistencia.clase.codigo, asistencia.links.links FROM a_estudiante JOIN asistencia.clase ON asistencia.a_estudiante.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo JOIN asistencia.links ON asistencia.a_estudiante.clase_id_clase = asistencia.links.clase_id_clase WHERE asistencia.a_estudiante.ida_estudiante = " . $clase . " GROUP BY asistencia.materia.nombre");
            //se inicia el recorrido para mostrar los datos de la BD

            while ($valores1 = mysqli_fetch_assoc($MostrarDatos)) {
                //declaracion de variables
                $nombremateria = $valores1['nombremateria'];
                $idMateria = $valores1['Materia_id_materia'];
                $codigo = $valores1['codigo'];
                $grupo = $valores1['nombregrupo'];
                $idgrupo = $valores1['id_grupo'];
                $links = $valores1['links'];
                $fecha = $valores1['fecha'];
                $id_clase = $valores1['clase_id_clase'];
            }
        }
        $mysql->desconectar();
        //Si el usuario es un estudiante
        if ($_SESSION['tipousuario'] == 1) {
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
                                <form id="contact" action="#" method="post">
                                    <!--<h3><?php echo "Clase: " . $nombremateria . "<br>Codigo generado: " . $codigo ?></h3>-->
                                    <h3>Datos de la clase</h3>
                                    <br>
                                    <div class="form-group row" align="right">
                                        <label class="col-sm-5 col-form-label">Clase seleccionada:</label>
                                        <div class="col-sm-6">
                                            <select class="form-select" id="newcodeidmateria" name="newcodeidmateria" required>
                                                <option value="<?php echo $idMateria ?>"><?php echo $nombremateria ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" align="right">
                                        <label class="col-sm-5 col-form-label">Codigo:</label>
                                        <div class="col-sm-6">
                                            <fieldset>
                                                <input placeholder="Codigo" disabled="" class="form-text" type="text" name="codigo" id="inputText" value="<?php echo $codigo ?>">
                                            </fieldset>
                                        </div>
                                    </div>
                                </form>

                                <form id="contact" action="clases_asistidas.php" method="post">
                                        <center>
                                            <h3>Links y/o comentarios a la clase adjuntados</h3>
                                        </center>
                                        <br>
                                        <div class="form-group row">
                                            <fieldset>
                                                <textarea name="comentarios" disabled><?php echo $links ?></textarea>
                                            </fieldset>
                                        </div>
                                        <fieldset>
                                            <button style="background-color: #037537;color: white; border:black;" name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-4">Volver</button>
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