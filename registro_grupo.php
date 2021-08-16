<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge" />-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistema acad&eacute;mico</title>
    <link href="css/style2.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/registro.css" rel="stylesheet" media="all">
    <link href="css/style.min.css" rel="stylesheet">
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
                //respectiva consulta para los select
        $seleccionEstudiante = $mysql->efectuarConsulta("SELECT asistencia.estudiante.id_estudiante, asistencia.estudiante.nombres from estudiante where asistencia.estudiante.estado = 1");
        $selecciongrupo = $mysql->efectuarConsulta("SELECT asistencia.grupo.id_grupo, asistencia.grupo.nombre from grupo where estado = 1 GROUP by asistencia.grupo.id_grupo");

        $selecciongrupo2 = $mysql->efectuarConsulta("SELECT asistencia.grupo.id_grupo as idgrupo, asistencia.grupo.nombre as nombregrupo, asistencia.grupo.Estudiante_id_estudiante, asistencia.estudiante.nombres from grupo join estudiante on asistencia.grupo.Estudiante_id_estudiante = asistencia.estudiante.id_estudiante where asistencia.grupo.estado = 1");
                
            }
        }
        $mysql->desconectar();
        //Si el usuario es un estudiante
        if ($_SESSION['tipousuario'] == 3) {
    ?>
    <br>
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <!--Informacion de la clase seleccionada en el formulario anterior-->
                        <center>
                        
                            <div class="col-md-6 col-md-offset-3">
                           
                                <form id="contact" action="Controlador/administrador/insertar_grupo.php" method="post">
                                <b>
                                <p class="mb-4">Registrar Grupo</p>
                                <p class="mb-4">Recuerda llenar todos los campos.</p>
                            </b>
                            <div class="form-group row" align="Left">
                                          <label class="col-sm-3 col-form-label">Id del grupo</label>
                                          <div class="col-sm-9">
                                            <input placeholder="..." class="form-control" type="text" name="id_grupo" id="inputText" required="">
                                          </div>
                                        </div>

                                        <div class="form-group row" align="Left">
                                          <label class="col-sm-3 col-form-label">Nombre del grupo</label>
                                          <div class="col-sm-9">
                                            <input placeholder="..." class="form-control" type="text" name="nombre_grupo" id="inputText" required="">
                                          </div>
                                        </div>

                                        <div class="form-group row" align="Left">
                                          <label class="col-sm-3 col-form-label">Estudiante:</label>
                                          <div class="col-sm-9">
                                            <select class="form-control" name="usuario" required>
                                                <option value="0" disabled="">Seleccione:</option>
                                                <?php
                                                //ciclo while 
                                                while ($resultado = mysqli_fetch_assoc($seleccionEstudiante)) {
                                                ?>
                                                    <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                                                    <option value="<?php echo $resultado['id_estudiante'] ?>"><?php echo $resultado['nombres'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                          </div>
                                        </div>

                                        <fieldset>
                                          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-3">Registrar</button>
                                        </fieldset>
                                        <br>
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