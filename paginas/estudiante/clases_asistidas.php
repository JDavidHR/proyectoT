<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge" />-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistema acad&eacute;mico</title>
    <link href="../../css/style2.css" rel="stylesheet" />
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="../../js/all.min.js" rel="stylesheet"></script>
</head>

<body class="sb-nav-fixed">
    <?php
    //Inicia sesion
    session_start();
    require_once '../../Modelo/MySQL.php';
    //creacion de nueva "consulta"
    $mysql = new MySQL;

    //Valida si un tipo de usuario inicio la sesion
    if (isset($_SESSION['tipousuario'])) {
        if ($_SESSION['tipousuario'] == 1) { //Sesion como estudiante
            //se conecta a la base de datos
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

            //consultas para las tablas de asistencia del estudiante
            $MostrarDatos = $mysql->efectuarConsulta("SELECT asistencia.a_estudiante.ida_estudiante, asistencia.a_estudiante.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre, asistencia.grupo.nombre as nombregrupo, asistencia.a_estudiante.fecha, asistencia.a_estudiante.asistio FROM a_estudiante JOIN asistencia.clase ON asistencia.a_estudiante.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo WHERE asistencia.a_estudiante.asistio = 'Si' GROUP BY asistencia.materia.nombre");

            $MostrarDatos2 = $mysql->efectuarConsulta("SELECT asistencia.a_estudiante.ida_estudiante, asistencia.a_estudiante.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre, asistencia.grupo.nombre as nombregrupo, asistencia.a_estudiante.fecha, asistencia.a_estudiante.asistio FROM a_estudiante JOIN asistencia.clase ON asistencia.a_estudiante.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo WHERE asistencia.a_estudiante.asistio = 'No' GROUP BY asistencia.materia.nombre");

            //se desconecta de la base de datos
            $mysql->desconectar();
    ?>
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <!-- Navbar Brand-->
                <a class="navbar-brand ps-3" href="index.php">Cotecnova - Inicio</a>
                <!-- Sidebar Toggle-->
                <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
                <!-- Navbar-->
                <ul class="d-none d-md-inline-block form-inline navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../../Controlador/cerrar_sesion.php">Cerrar sesi&oacute;n</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <div class="sb-sidenav-menu-heading">Men&uacute;</div>
                                <a class="nav-link" href="consultar_horario.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                                    Consultar horario
                                </a>
                                <a class="nav-link" href="validar_asistencia.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                                    Validar asistencia
                                </a>
                                <a class="nav-link" href="clases_asistidas.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                    Clases asistidas
                                </a>
                            </div>
                        </div>
                        <div class="sb-sidenav-footer" style="color: #C6C6C6;">
                            <div class="small">Sesi&oacute;n iniciada como:</div>
                            <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?>
                        </div>
                    </nav>
                </div>
                <div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h2 class="mt-4" style="color: #6F6F6F;">Bienvenid@ <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?></h2>
                            <br><br>
                            <div class="row">
                                <center>
                                    <div class="col-md-6 col-md-offset-3">
                                        <table id="" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Documento</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Carrera</th>
                                                    <th scope="col">Semestre</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $documento ?></td>
                                                    <td><?php echo $nombres . " " . $apellidos ?></td>
                                                    <td><?php echo $carrera ?></td>
                                                    <td><?php echo $semestre ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!--tabla de clases asistidas-->
                                    <br><br>
                                    <div class="row">
                                        <center>
                                            <i><b>
                                                    <p class="mb-4">Clases Asistidas</p>
                                                </b></i>
                                        </center>
                                    </div>

                                    <div class="col-md-6 col-md-offset-3">
                                        <table id="" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Clase</th>
                                                    <th scope="col">Grupo</th>
                                                    <th scope="col">Fecha de Registro</th>
                                                    <th scope="col">Asistio</th>
                                                    <th scope="col">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    while ($valores1 = mysqli_fetch_assoc($MostrarDatos)) {
                                                        $ida_estudiante = $valores1['ida_estudiante'];
                                                    ?>
                                                        <td><?php echo $valores1['nombre'] ?></td>
                                                        <td><?php echo $valores1['nombregrupo'] ?></td>
                                                        <td><?php echo $valores1['fecha'] ?></td>
                                                        <td style="color: green;"><?php echo $valores1['asistio'] ?></td>
                                                        <td>
                                                            <div class="text-center">
                                                                <a class="btn" style="background-color: #2EC82E;color: white" href='vista_a_estudiante.php?ida_estudiante=<?php echo $ida_estudiante; ?>' role="button"><i class="fas fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                </tr>
                                            <?php
                                                    }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <!--tabla de clases no asistidas-->
                                    <br><br>
                                    <div class="row">
                                        <center>
                                            <i><b>
                                                    <p class="mb-4">Clases no Asistidas</p>
                                                </b></i>
                                        </center>
                                    </div>

                                    <div class="col-md-6 col-md-offset-3">
                                        <table id="" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                                <tr>
                                                    <th scope="col">Clase</th>
                                                    <th scope="col">Grupo</th>
                                                    <th scope="col">Fecha de Registro</th>
                                                    <th scope="col">Asistio</th>
                                                    <th scope="col">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    while ($valores2 = mysqli_fetch_assoc($MostrarDatos2)) {
                                                        $ida_estudiante = $valores1['ida_estudiante'];
                                                    ?>
                                                        <td><?php echo $valores2['nombre'] ?></td>
                                                        <td><?php echo $valores2['nombregrupo'] ?></td>
                                                        <td><?php echo $valores2['fecha'] ?></td>
                                                        <td style="color: red;"><?php echo $valores2['asistio'] ?></td>
                                                        <td>
                                                            <div class="text-center">
                                                                <a class="btn" style="background-color: #2EC82E;color: white" href='vista_a_estudiante.php?ida_estudiante=<?php echo $ida_estudiante; ?>' role="button"><i class="fas fa-eye"></i></a>
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
        }
    } else {
        header("refresh:0;url=login.php");
    }
    ?>
</body>
</html>