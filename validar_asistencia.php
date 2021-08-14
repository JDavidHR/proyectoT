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
        //respectiva consulta para la seleccion de usuario
        $datosestudiante = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, estudiante.documento, estudiante.nombres, estudiante.apellidos, estudiante.Carrera_id_carrera, estudiante.semestre, carrera.id_carrera, carrera.nombre from estudiante join carrera on estudiante.Carrera_id_carrera = carrera.id_carrera where estudiante.id_estudiante = " . $id_estudiante . "");
        while ($valores1 = mysqli_fetch_assoc($datosestudiante)) {
            $documento = $valores1['documento'];
            $nombres = $valores1['nombres'];
            $apellidos = $valores1['apellidos'];
            $carrera = $valores1['nombre'];
            $semestre = $valores1['semestre'];
        }

        //consultas para la del estudiante
        $seleccionmateria = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, grupo.Estudiante_id_estudiante, materia.nombre as nombremateria, materia.id_materia FROM estudiante JOIN grupo on estudiante.id_estudiante = grupo.Estudiante_id_estudiante join clase on clase.Grupo_id_grupo = grupo.id_grupo join materia on materia.id_materia = clase.Materia_id_materia where estudiante.id_estudiante = " . $id_estudiante . " group by id_materia");
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
                        <center>
                            <b>
                                <p class="mb-4">
                                    Recuerda que para registrar tu asistencia necesitas el codigo generado
                                    por el docente, ¡Pidelo primero!
                                </p>
                            </b>
                        </center>
                    </div>
                    <br>

                    <div class="row">
                        <center>
                            <div class="col-md-6 col-md-offset-3">
                                <table id="" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            while ($valores1 = mysqli_fetch_assoc($seleccionmateria)) {
                                                $id_materia = $valores1['id_materia'];
                                            ?>
                                            <td><?php echo $valores1['id_materia'] ?></td>
                                            <td><?php echo $valores1['nombremateria'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <a class="btn" style="background-color: #2EC82E;color: white" href='validar_asistencia2.php?id_materia=<?php echo $id_materia; ?>' role="button"><i class="fas fa-check-circle "></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                            <?php
                                            }
                                            ?>
                                    </tbody>
                                </table>
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