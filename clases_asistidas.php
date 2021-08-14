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
        if(isset($_SESSION['tipousuario'])){
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

            //consultas para las tablas de asistencia del estudiante
            $MostrarDatos = $mysql->efectuarConsulta("SELECT asistencia.a_estudiante.ida_estudiante, asistencia.a_estudiante.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre, asistencia.grupo.nombre as nombregrupo, asistencia.a_estudiante.fecha, asistencia.a_estudiante.asistio FROM a_estudiante JOIN asistencia.clase ON asistencia.a_estudiante.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo WHERE asistencia.a_estudiante.asistio = 'Si' GROUP BY asistencia.materia.nombre");

            $MostrarDatos2 = $mysql->efectuarConsulta("SELECT asistencia.a_estudiante.ida_estudiante, asistencia.a_estudiante.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre, asistencia.grupo.nombre as nombregrupo, asistencia.a_estudiante.fecha, asistencia.a_estudiante.asistio FROM a_estudiante JOIN asistencia.clase ON asistencia.a_estudiante.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo WHERE asistencia.a_estudiante.asistio = 'No' GROUP BY asistencia.materia.nombre");
        }
        $mysql->desconectar();
        //Si el usuario es un estudiante
        if($_SESSION['tipousuario'] == 1){
        ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
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
                                                <td><?php echo $nombres." ".$apellidos ?></td>
                                                <td><?php echo $carrera ?></td>
                                                <td><?php echo $semestre ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </center>
                        </div>
                        <br><br>

                        <center>
                            <b><p class="mb-4">Distribuci&oacute;n de las clases</p></b>
                        </center>
                        <div class="row">
                            <center>
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
        
        ?>

        <!-- En caso de que no haya una sesion, se redirige al login-->
        <?php
        }else{
            header( "refresh:0;url=login.php" );    
        }
        ?>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
