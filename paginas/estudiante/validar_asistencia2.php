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
                                                    <p class="mb-4">
                                                        Registro de Asistencia
                                                    </p>
                                                </b></i>
                                        </center>
                                    </div>

                                    <div class="col-md-6 col-md-offset-3">
                                        <form id="contact" action="../../Controlador/estudiante/validar_asistencia.php" method="post">
                                            <div class="container col-md-7 col-md-offset-3" style="text-align: center">
                                                <center>
                                                    <h3>Registro de Asistencia</h3>
                                                    <br>
                                                </center>

                                                <div class="form-group row" align="right">
                                                    <label class="col-sm-5 col-form-label">Clase seleccionada:</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control " id="idmateria" name="idmateria" required>
                                                            <option value="<?php echo $id_materia ?>"><?php echo $materia ?></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row" align="right">
                                                    <label class="col-sm-5 col-form-label">Codigo de la clase:</label>
                                                    <div class="col-sm-7">
                                                        <fieldset>
                                                            <input class="form-control " name="codigo_clase" placeholder="Escriba el codigo aqui" required>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                                <div class="form-group row" align="right">
                                                    <label class="col-sm-5 col-form-label">Fecha de registro:</label>
                                                    <div class="col-sm-7">
                                                        <input type="date" name="fechaclase" class="form-control" required>
                                                    </div>
                                                </div>

                                                <br>
                                                <fieldset>
                                                    <button style="background-color: green;color: white; border:black;" name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-4">Validar</button>
                                                </fieldset>
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
    <?php
        }
    } else {
        header("refresh:0;url=login.php");
    }
    ?>

</body>

</html>