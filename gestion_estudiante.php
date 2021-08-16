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
            if (isset($_SESSION['idAdministrador'])) {
                //respectiva consulta para la seleccion de usuario
                $MostrarDatos = $mysql->efectuarConsulta("SELECT asistencia.estudiante.id_estudiante, asistencia.estudiante.documento, asistencia.estudiante.nombres, asistencia.estudiante.apellidos, asistencia.estudiante.jornada, asistencia.estudiante.semestre, asistencia.carrera.nombre, asistencia.estudiante.correo from estudiante JOIN carrera on carrera.id_carrera = Carrera_id_carrera where asistencia.estudiante.estado = 1");

                $MostrarDatos2 = $mysql->efectuarConsulta("SELECT asistencia.estudiante.id_estudiante, asistencia.estudiante.documento, asistencia.estudiante.nombres, asistencia.estudiante.apellidos, asistencia.estudiante.jornada, asistencia.estudiante.semestre, asistencia.carrera.nombre, asistencia.estudiante.correo from estudiante JOIN carrera on carrera.id_carrera = Carrera_id_carrera where asistencia.estudiante.estado = 0");
            }
            $mysql->desconectar();
            //Si el usuario es un estudiante
            if ($_SESSION['tipousuario'] == 3) {
    ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <center>
                            <b>
                                <p class="mb-4">Gestionar Estudiantes</p>
                            </b>
                        </center>
                        <div class="row">
                            <center>
                                <div class="col-md-10 col-md-offset-3">
                                    <table id="" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre Completo</th>
                                                <th>Documento</th>
                                                <th>Jornada</th>
                                                <th>Semestre</th>
                                                <th>Carrera</th>
                                                <th>Correo</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                while ($valores1 = mysqli_fetch_assoc($MostrarDatos)) {
                                                    $id_estudiante = $valores1['id_estudiante'];
                                                ?>
                                                    <td><?php echo $valores1['id_estudiante'] ?></td>
                                                    <td><?php echo $valores1['nombres'] . " " . $valores1['apellidos'] ?></td>
                                                    <td><?php echo $valores1['documento'] ?></td>
                                                    <td><?php echo $valores1['jornada'] ?></td>
                                                    <td><?php echo $valores1['semestre'] ?></td>
                                                    <td><?php echo $valores1['nombre'] ?></td>
                                                    <td><?php echo $valores1['correo'] ?></td>
                                                    <td>
                                                        <div class="text-center">
                                                            <a class="btn" style="background-color: #2EC82E;color: white" href='update_estudiante2.php?id_estudiante=<?php echo $id_estudiante; ?>' role="button"><i class="fas fa-user-edit"></i></a>
                                                            <a class="btn" style="background-color: #FF5454;color: white" href='Controlador/administrador/delete_estudiante.php?id_estudiante=<?php echo $id_estudiante; ?>' role="button"><i class="fas fa-user-minus"></i></a>
                                                        </div>
                                                    </td>
                                            </tr>
                                        <?php
                                                }
                                        ?>
                                        </tbody>
                                    </table>
                                    <a class="btn" style="background-color: #2962FF;color: white" href="registro_usuario.php" role="button"><i class="fas fa-user-plus"></i> Agregar Nuevo</a>
                                </div>
                            </center>
                            
                        </div>
                        
                        <br><br>

                        <center>
                            <b>
                                <p class="mb-4">Estudiantes desactivados/eliminados</p>
                            </b>
                        </center>
                        <div class="row">
                            <center>
                                <div class="col-md-10 col-md-offset-3">
                                    <table id="" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th>Id</th>
                        <th>Nombre completo</th>
                        <th>Documento</th>
                        <th>Jornada</th>
                        <th>Semestre</th>
                        <th>Carrera</th>
                        <th>Correo</th>
                        <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                        <?php
                        while ($valores1 = mysqli_fetch_assoc($MostrarDatos2)) {
                          $id_estudiante = $valores1 ['id_estudiante'];
                        ?>
                          <td><?php echo $valores1['id_estudiante'] ?></td>
                          <td><?php echo $valores1['nombres']." ".$valores1['apellidos'] ?></td>
                          <td><?php echo $valores1['documento'] ?></td>
                          <td><?php echo $valores1['jornada'] ?></td>
                          <td><?php echo $valores1['semestre'] ?></td>
                          <td><?php echo $valores1['nombre'] ?></td>
                          <td><?php echo $valores1['correo'] ?></td>
                          <td>
                            <div class="text-center">
                              <a class="btn" style="background-color: #2EC82E;color: white" href='Controlador/administrador/activar_estudiante.php?id_estudiante=<?php echo $id_estudiante; ?>' role="button"><i class="fas fa-user-check"></i></a>
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
                        <br><br>

                        
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