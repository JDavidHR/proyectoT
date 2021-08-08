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

            //consultas para las tablas de horario y materias matriculadas del estudiante
            $dhorario = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, clase.id_clase, clase.hora, clase.horafin, dias.id_dia, dias.nombre as nombredia, materia.nombre FROM estudiante JOIN grupo on estudiante.id_estudiante = grupo.Estudiante_id_estudiante join clase on clase.Grupo_id_grupo = grupo.id_grupo join materia on materia.id_materia = clase.Materia_id_materia join dias on dias.id_dia = clase.Dias_id_dia where estudiante.id_estudiante = " . $id_estudiante . " ORDER BY clase.hora, nombredia");
            $Amaterias = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, grupo.Estudiante_id_estudiante, materia.nombre as nombremateria, materia.id_materia, docente.nombres, aula.nombre as nombreaula, dias.nombre as nombredia, clase.hora FROM estudiante JOIN grupo on estudiante.id_estudiante = grupo.Estudiante_id_estudiante join clase on clase.Grupo_id_grupo = grupo.id_grupo join materia on materia.id_materia = clase.Materia_id_materia join docente on docente.id_docente = clase.Docente_id_docente join aula on aula.id_aula = clase.Aula_id_aula join dias on dias.id_dia = clase.Dias_id_dia where estudiante.id_estudiante = " . $id_estudiante . " order by clase.hora");


            //Codigo proporcionado por el usuario Triby en stack overflow
            //https://es.stackoverflow.com/questions/390749/como-poner-campos-en-una-tabla-php-y-mysql
            // Crear arreglo para armar horario
            $horario = [];

            while ($valores1 = mysqli_fetch_assoc($dhorario)) {
                // Verificar que existe hora_inicial en arreglo
                $hora = $valores1['hora']; // . ' - ' . $valores1['horafin'];
                $horafin = $valores1['horafin'];
                $materia = $valores1['nombre'];
                if (!isset($horario[$hora])) {
                    // Crear arreglo con 5 elementos, uno para cada día
                    $horario[$hora] = ['', '', '', '', '', '', ''];
                }
                // Agregar materia a $hora, en espacio correspondiente
                // Los índices de arreglo inician en cero, van de cero = lunes a 4 = viernes
                // Por eso el - 1
                $horario[$hora][$valores1['id_dia'] - 1] = $valores1['nombre'] . " " . $hora . " - " . $horafin;
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

                                    <!--tabla del horario-->
                                    <br><br>
                                    <div class="row">
                                        <center>
                                            <i><b><p class="mb-4">Distribuci&oacute;n de las clases</p></b></i>
                                        </center>
                                    </div>

                                    <div class="col-md-6 col-md-offset-3">
                                        <table id="" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Lunes</th>
                                                    <th>Martes</th>
                                                    <th>Miercoles</th>
                                                    <th>Jueves</th>
                                                    <th>Viernes</th>
                                                    <th>Sabado</th>
                                                    <th>Domingo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Llenar tabla
                                                foreach ($horario as $hora => $dias) {
                                                    echo "
											            <tr>
											                <!-- <td>$hora</td> -->
											                <td>{$dias[0]}</td>
											                <td>{$dias[1]}</td>
											                <td>{$dias[2]}</td>
											                <td>{$dias[3]}</td>
											                <td>{$dias[4]}</td>
											                <td>{$dias[5]}</td>
											                <td></td>
											            </tr>";
                                                    //HTML; // Esta línea debe estar en la primera columna, sin espacios ni tabuladores previos
                                                }
                                                // Cerrar tabla
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <!--tabla de asignaturas matriculadas-->
                                    <br><br>
                                    <div class="row">
                                        <center>
                                            <i><b><p class="mb-4">Asignaturas Matriculadas</p></b></i>
                                        </center>
                                    </div>

                                    <div class="col-md-6 col-md-offset-3">
                                        <table id="" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Codigo</th>
                                                    <th scope="col">Asignatura</th>
                                                    <th scope="col">Docente</th>
                                                    <th scope="col">Aula</th>
                                                    <th scope="col">Dia</th>
                                                    <th scope="col">Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    while ($valores3 = mysqli_fetch_assoc($Amaterias)) {
                                                    ?>
                                                        <th scope="row"><?php echo $valores3['id_materia'] ?></th>
                                                        <td><?php echo $valores3['nombremateria'] ?></td>
                                                        <td><?php echo $valores3['nombres'] ?></td>
                                                        <td><?php echo $valores3['nombreaula'] ?></td>
                                                        <td><?php echo $valores3['nombredia'] ?></td>
                                                        <td><?php echo $valores3['hora'] ?></td>
                                                </tr>
                                            <?php
                                                    }
                                            ?>
                                            </tr>
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