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
            $id_docente = $_SESSION['idDocente'];
            //$id = $_POST['materiaselect'];

            $datosdocente = $mysql->efectuarConsulta("SELECT docente.id_docente, docente.nombres, docente.apellidos, docente.documento, docente.tipo_usuario_id_tipo_usuario, tipo_usuario.nombre from docente join tipo_usuario on tipo_usuario.id_tipo_usuario = docente.tipo_usuario_id_tipo_usuario where docente.id_docente = " . $id_docente . "");
            while ($valores1 = mysqli_fetch_assoc($datosdocente)) {
                $documento = $valores1['documento'];
                $nombres = $valores1['nombres'];
                $apellidos = $valores1['apellidos'];
                $tipo_usuario = $valores1['nombre'];
            }

            $MostrarDatos = $mysql->efectuarConsulta("SELECT asistencia.a_docente.ida_docente, asistencia.a_docente.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre, asistencia.grupo.nombre as nombregrupo, asistencia.a_docente.fecha, asistencia.a_docente.estado FROM a_docente JOIN asistencia.clase ON asistencia.a_docente.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo WHERE asistencia.a_docente.estado = 'Activa' AND asistencia.a_docente.estado2 = 1 GROUP BY asistencia.a_docente.fecha");

            $MostrarDatos2 = $mysql->efectuarConsulta("SELECT asistencia.a_docente.ida_docente, asistencia.a_docente.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre, asistencia.grupo.nombre as nombregrupo, asistencia.a_docente.fecha, asistencia.a_docente.estado FROM a_docente JOIN asistencia.clase ON asistencia.a_docente.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo WHERE asistencia.a_docente.estado = 'Inactiva' AND asistencia.a_docente.estado2 = 1 GROUP BY asistencia.a_docente.fecha");
        }
        $mysql->desconectar();
        //Si el usuario es un estudiante
        if ($_SESSION['tipousuario'] == 2) {
    ?>
    <br>
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
                                            <th scope="col">Tipo de usuario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $documento ?></td>
                                            <td><?php echo $nombres . " " . $apellidos ?></td>
                                            <td><?php echo $tipo_usuario ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </center>
                    </div>
                    <br><br>

                    <div class="row">
                        <center>
                            <!--tabla de clases asistidas-->
                            <div class="card mb-4 col-md-10 col-md-offset-3">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Clases vistas (Activas)
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Nombre de la clase</th>
                                                <th>Nombre del grupo</th>
                                                <th>Fecha de registro</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre de la clase</th>
                                                <th>Nombre del grupo</th>
                                                <th>Fecha de registro</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <?php
                                                while ($valores1 = mysqli_fetch_assoc($MostrarDatos)) {
                                                    $ida_docente = $valores1['ida_docente'];
                                                ?>
                                                    <td><?php echo $valores1['nombre'] ?></td>
                                                    <td><?php echo $valores1['nombregrupo'] ?></td>
                                                    <td><?php echo $valores1['fecha'] ?></td>
                                                    <td><?php echo $valores1['estado'] ?></td>
                                                    <td>
                                                        <div class="text-center">
                                                            <a class="btn" style="background-color: #2EC82E;color: white" href='update_a_docente.php?ida_docente=<?php echo $ida_docente; ?>' role="button"><i class="fas fa-eye"></i></a>
                                                            <a class="btn" style="background-color: #FF5454;color: white" href='Controlador/delete_a_docente.php?ida_docente=<?php echo $ida_docente; ?>' role="button"><i class="fas fa-trash"></i></a>
                                                            <a class="btn" style="background-color: #2962FF;color: white" href='Controlador/desactivar_clase.php?ida_docente=<?php echo $ida_docente; ?>' role="button"><i class="fas fa-eye-slash"></i></a>
                                                        </div>
                                                    </td>
                                            </tr>
                                                <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br><br>

                            <!--tabla de clases no asistidas-->
                            <div class="card mb-4 col-md-10 col-md-offset-3">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Clases vistas (Inactivas)
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple2">
                                        <thead>
                                            <tr>
                                                <th>Nombre de la clase</th>
                                                <th>Nombre del grupo</th>
                                                <th>Fecha de registro</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre de la clase</th>
                                                <th>Nombre del grupo</th>
                                                <th>Fecha de registro</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <?php
                                                while ($valores1 = mysqli_fetch_assoc($MostrarDatos2)) {
                                                    $ida_docente = $valores1['ida_docente'];
                                                ?>
                                                    <td><?php echo $valores1['nombre'] ?></td>
                                                    <td><?php echo $valores1['nombregrupo'] ?></td>
                                                    <td><?php echo $valores1['fecha'] ?></td>
                                                    <td><?php echo $valores1['estado'] ?></td>
                                                    <td>
                                                        <div class="text-center">
                                                            <a class="btn" style="background-color: #FF5454;color: white" href='Controlador/delete_a_docente.php?ida_docente=<?php echo $ida_docente; ?>' role="button"><i class="fas fa-trash"></i></a>
                                                            <a class="btn" style="background-color: #2962FF;color: white" href='Controlador/activar_clase2.php?ida_docente=<?php echo $ida_docente; ?>' role="button"><i class="fas fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                            </tr>
                                                <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
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
    <script src="js/simple-datatables.js"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="js/datatables-simple-demoo.js"></script>
</body>

</html>