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
        <?php 
            //Inicia sesion
            //session_start();
            require_once 'Modelo/MySQL.php';
            //creacion de nueva "consulta"
            $mysql = new MySQL;
        
            //Valida si un tipo de usuario inicio la sesion
            if(isset($_SESSION['tipousuario'])){
                if($_SESSION['tipousuario'] == 1){ //Sesion como estudiante
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
                        <li><a class="dropdown-item" href="Controlador/cerrar_sesion.php">Cerrar sesi&oacute;n</a></li>
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
                        <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']?>
                    </div>
                </nav>
            </div>
        </div>
        <?php
            }else if($_SESSION['tipousuario'] == 2){ //Sesion como docente
                //se conecta a la base de datos
                $mysql->conectar();
                $id_docente = $_SESSION['idDocente'];

                $datosdocente = $mysql->efectuarConsulta("SELECT docente.id_docente, docente.nombres, docente.apellidos, docente.documento, docente.tipo_usuario_id_tipo_usuario, tipo_usuario.nombre from docente join tipo_usuario on tipo_usuario.id_tipo_usuario = docente.tipo_usuario_id_tipo_usuario where docente.id_docente = " . $id_docente . "");
                while ($valores2 = mysqli_fetch_assoc($datosdocente)) {
                    $documento = $valores2['documento'];
                    $nombres = $valores2['nombres'];
                    $tipo_usuario = $valores2['nombre'];
                    $apellidos = $valores2['apellidos'];
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
                        <li><a class="dropdown-item" href="Controlador/cerrar_sesion.php">Cerrar sesi&oacute;n</a></li>
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
                            <a class="nav-link" href="consultar_clase.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                                Consultar clase
                            </a>
                            <a class="nav-link" href="registro_clase_docente.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                                Registrar clase
                            </a>
                            <a class="nav-link" href="clases_vistas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Clases vistas
                            </a>
                            <a class="nav-link" href="email/index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-link"></i></div>
                                Enviar correos/material
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="color: #C6C6C6;">
                        <div class="small">Sesi&oacute;n iniciada como:</div>
                        <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']?>
                    </div>
                </nav>
            </div>
        </div>
        <?php
            }else if($_SESSION['tipousuario'] == 3){ //Sesion como administrador
                //se conecta a la base de datos
                $mysql->conectar();
                $id_administrador = $_SESSION['idAdministrador'];

                $datosadministrador = $mysql->efectuarConsulta("SELECT administrador.id_administrador, administrador.nombres, administrador.apellidos, administrador.documento from administrador where administrador.id_administrador = " . $id_administrador . "");
                while ($valores3 = mysqli_fetch_assoc($datosadministrador)) {
                    $documento = $valores3['documento'];
                    $nombres = $valores3['nombres'];
                    $apellidos = $valores3['apellidos'];
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
                        <li><a class="dropdown-item" href="Controlador/cerrar_sesion.php">Cerrar sesi&oacute;n</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Gestiones</div>
                            <a class="nav-link" href="gestion_estudiante.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                                Gestionar Estudiantes
                            </a>
                            <a class="nav-link" href="gestion_docente.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                                Gestionar Docentes
                            </a>
                            <a class="nav-link" href="gestion_aulas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-house-user"></i></div>
                                Gestionar Aulas
                            </a>
                            <a class="nav-link" href="gestion_materias.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                                Gestionar Materias
                            </a>
                            <a class="nav-link" href="gestion_clases.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                                Gestionar Clases
                            </a>
                            <a class="nav-link" href="gestion_Carrera.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                                Gestionar Carreras
                            </a>
                            <a class="nav-link" href="gestion_grupo.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-id-badge"></i></div>
                                Gestionar Grupos
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="color: #C6C6C6;">
                        <div class="small">Sesi&oacute;n iniciada como:</div>
                        <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']?>
                    </div>
                </nav>
            </div>
        </div>
        <?php
            }
        }else{
         header( "refresh:0;url=login.php" );    
        }
        ?>

    </body>
</html>
