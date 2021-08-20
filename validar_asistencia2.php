<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge" />-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistema acad&eacute;mico</title>
    <link href="css/style2.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
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
            $id_materia = $_GET['id_materia'];
            //respectiva consulta para la seleccion de usuario
            $datosestudiante = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, estudiante.documento, estudiante.nombres, estudiante.apellidos, estudiante.Carrera_id_carrera, estudiante.semestre, carrera.id_carrera, carrera.nombre from estudiante join carrera on estudiante.Carrera_id_carrera = carrera.id_carrera where estudiante.id_estudiante = " . $id_estudiante . "");
            while ($valores1 = mysqli_fetch_assoc($datosestudiante)) {
                $documento = $valores1['documento'];
                $nombres = $valores1['nombres'];
                $apellidos = $valores1['apellidos'];
                $carrera = $valores1['nombre'];
                $semestre = $valores1['semestre'];
            }

            //consulta para la validacion del estudiante
            $mostrardatos = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, materia.nombre from estudiante join grupo on grupo.Estudiante_id_estudiante = estudiante.id_estudiante join clase on clase.Grupo_id_grupo = grupo.id_grupo join materia on materia.id_materia = clase.Materia_id_materia where asistencia.materia.id_materia = " . $id_materia . "");
            //se inicia el recorrido para mostrar los datos de la BD
            while ($valores1 = mysqli_fetch_assoc($mostrardatos)) {
                //declaracion de variables
                $materia = $valores1['nombre'];
            }
        }
        $mysql->desconectar();
        //Si el usuario es un estudiante
        if ($_SESSION['tipousuario'] == 1) {
    ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <!--tabla de clases asistidas-->
                    <div class="row">
                        <center>
                            <div class="col-md-6 col-md-offset-3">
                                <form id="contact" action="Controlador/estudiante/validar_asistencia.php" method="post">
                                    <div style="text-align: center">
                                        <h3>Registro de Asistencia</h3>
                                        <br>
                                        <div class="form-group row" align="right">
                                            <label class="col-sm-5 col-form-label">Clase seleccionada:</label>
                                            <div class="col-sm-6">
                                                <select class="form-select" id="idmateria" name="idmateria" required>
                                                    <option value="<?php echo $id_materia ?>"><?php echo $materia ?></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row" align="right">
                                            <label class="col-sm-5 col-form-label">Codigo de la clase:</label>
                                            <div class="col-sm-6">
                                                <fieldset>
                                                    <input class="form-control " name="codigo_clase" placeholder="Escriba el codigo aqui" required>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="form-group row" align="right">
                                            <label class="col-sm-5 col-form-label">Fecha de registro:</label>
                                            <div class="col-sm-6">
                                                <input type="date" name="fechaclase" class="form-control" required>
                                            </div>
                                        </div>

                                        <br>
                                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-3">Validar</button>
                                    </div>
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