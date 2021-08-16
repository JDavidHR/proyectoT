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
                $MostrarDatos = $mysql->efectuarConsulta("SELECT asistencia.carrera.id_carrera, asistencia.carrera.nombre from carrera where asistencia.carrera.estado = 1");
                $MostrarDatos2 = $mysql->efectuarConsulta("SELECT asistencia.carrera.id_carrera, asistencia.carrera.nombre from carrera where asistencia.carrera.estado = 0");
            }
            $mysql->desconectar();
            //Si el usuario es un estudiante
            if ($_SESSION['tipousuario'] == 3) {
    ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                <br><br>

                <center>
                    <b>
                        <p class="mb-4">Carreras</p>
                    </b>
                </center>
                    <div class="row">
                        <center>
                        <div class="card mb-10 col-md-6 col-md-offset-3">
                            <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php
                                            while ($valores1 = mysqli_fetch_assoc($MostrarDatos)) {
                                            $id_carrera = $valores1 ['id_carrera'];
                                            ?>
                                            <td><?php echo $valores1['id_carrera'] ?></td>
                                            <td><?php echo $valores1['nombre'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                <a class="btn" style="background-color: #2EC82E;color: white" href='update_carreras2.php?id_carrera=<?php echo $id_carrera; ?>' role="button"><i class="fas fa-edit"></i></a>
                                                <a class="btn" style="background-color: #FF5454;color: white" href='Controlador/administrador/delete_carrera.php?id_carrera=<?php echo $id_carrera; ?>' role="button"><i class="fas fa-minus-square"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <a class="btn" style="background-color: #2962FF;color: white" href="registro_carrera.php" role="button"><i class="fas fa-graduation-cap"></i> Agregar Nuevo</a>
                                    
                                </div>
                            </center>
                            
                        </div>
                        
                        <br><br>

                        <center>
                            <b>
                                <p class="mb-4">Carreras desactivados/eliminados</p>
                            </b>
                        </center>
                        <div class="row">
                            <center>
                            <div class="card mb-10 col-md-6 col-md-offset-3">
                            <div class="card-body">
                                    <table id="datatablesSimple2">
                                        <thead>
                                            <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php
                                            while ($valores1 = mysqli_fetch_assoc($MostrarDatos2)) {
                                            $id_carrera = $valores1 ['id_carrera'];
                                            ?>
                                            <td><?php echo $valores1['id_carrera'] ?></td>
                                            <td><?php echo $valores1['nombre'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                <a class="btn" style="background-color: #2EC82E;color: white" href='Controlador/administrador/activar_carrera.php?id_carrera=<?php echo $id_carrera; ?>' role="button"><i class="fas fa-check"></i></a>
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
<script src="js/simple-datatables.js"></script>
<script src="js/datatables-simple-demo.js"></script>
<script src="js/datatables-simple-demoo.js"></script>
</body>

</html>