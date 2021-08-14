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
            $id = $_POST['materiaselect'];

            $datosdocente = $mysql->efectuarConsulta("SELECT docente.id_docente, docente.nombres, docente.documento, docente.tipo_usuario_id_tipo_usuario, tipo_usuario.nombre from docente join tipo_usuario on tipo_usuario.id_tipo_usuario = docente.tipo_usuario_id_tipo_usuario where docente.id_docente = " . $id_docente . "");
            while ($valores1 = mysqli_fetch_assoc($datosdocente)) {
                $documento = $valores1['documento'];
                $nombres = $valores1['nombres'];
                $tipo_usuario = $valores1['nombre'];
            }
            //respectiva consulta para la seleccion de usuario
            $seleccionmateria = $mysql->efectuarConsulta("SELECT asistencia.docente.id_docente, asistencia.materia.nombre as nombremateria, asistencia.materia.id_materia from docente join clase on asistencia.clase.Docente_id_docente = asistencia.docente.id_docente join grupo on asistencia.grupo.id_grupo = asistencia.clase.Grupo_id_grupo join materia on materia.id_materia = asistencia.clase.Materia_id_materia where asistencia.clase.Materia_id_materia = " . $id . " GROUP BY asistencia.materia.id_materia");
            //se inicia el recorrido para mostrar los datos de la BD

            while ($valores1 = mysqli_fetch_assoc($seleccionmateria)) {
                //declaracion de variables
                $smateria = $valores1['nombremateria'];
            }

            $selecciongrupo = $mysql->efectuarConsulta("SELECT asistencia.clase.Grupo_id_grupo, asistencia.grupo.nombre as nombregrupo FROM clase JOIN grupo on asistencia.grupo.id_grupo = asistencia.clase.Grupo_id_grupo WHERE asistencia.clase.Materia_id_materia = " . $id . " GROUP BY asistencia.grupo.id_grupo");
        }
        $mysql->desconectar();
        //Si el usuario es un estudiante
        if ($_SESSION['tipousuario'] == 2) {
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
                            <div class="col-md-4 col-md-offset-3">
                                <form id="contact" action="registro_clase_docente3.php" method="post">
                                    <?php echo "Materia seleccionada: " ?>
                                    <br>
                                    <select class="form-control " id="materianombre" name="materianombre" required>
                                        <option value="<?php echo $id ?>"><?php echo $smateria ?></option>
                                    </select>
                                    <br>
                                    <?php echo "Grupos disponibles: " ?>
                                    <br>
                                    <fieldset>
                                        <select class="form-control " name="selectgrupo" required>
                                            <?php
                                            //ciclo while que nos sirve para traer cuales son los grpos disponibles
                                            while ($resultado = mysqli_fetch_assoc($selecciongrupo)) {
                                            ?>
                                                <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                                                <option value="<?php echo $resultado['Grupo_id_grupo'] ?>"><?php echo $resultado['nombregrupo'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-3" style="background-color: green;color:white;border:black;">Seleccionar</button>
                                    </fieldset>
                                </form>
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