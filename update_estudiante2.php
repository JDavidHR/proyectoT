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
                //respectiva consulta para la seleccion de usuario
                $id_estudiante = $_GET['id_estudiante'];
                $mostrardatos = $mysql->efectuarConsulta("SELECT asistencia.estudiante.documento,asistencia.estudiante.nombres,asistencia.estudiante.apellidos,asistencia.estudiante.jornada,asistencia.estudiante.semestre,asistencia.estudiante.clave,asistencia.estudiante.correo,asistencia.estudiante.Carrera_id_carrera,asistencia.estudiante.tipo_usuario_id_tipo_usuario from estudiante WHERE asistencia.estudiante.id_estudiante = " . $id_estudiante . "");


                $seleccionUsuario = $mysql->efectuarConsulta("SELECT asistencia.tipo_usuario.id_tipo_usuario, asistencia.tipo_usuario.nombre from tipo_usuario where asistencia.tipo_usuario.id_tipo_usuario = 1");
                //$seleccionhorario = $mysql->efectuarConsulta("SELECT asistencia.horario.id_horario from horario");
                $seleccioncarrera = $mysql->efectuarConsulta("SELECT asistencia.carrera.id_carrera, asistencia.carrera.nombre from carrera");
                while ($valores1 = mysqli_fetch_assoc($mostrardatos)) {
                  //declaracion de variables
                  $doc = $valores1['documento'];
                  $nombre = $valores1['nombres'];
                  $apellido = $valores1['apellidos'];
                  $jornada = $valores1['jornada'];
                  $semestre = $valores1['semestre'];
                  $clave = $valores1['clave'];
                  $correo = $valores1['correo'];
                  
                  $carrera = $valores1['Carrera_id_carrera'];
                  $tipo = $valores1['tipo_usuario_id_tipo_usuario'];
                }
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
                            <b>
                                <h4 class="mb-4">Actualizar Estudiante</h4>
                            </b>
                                <form id="contact" action="Controlador/administrador/update_estudiante.php?id=<?php echo $id_estudiante; ?>" method="post">
                                <div class="form-group row" align="Left">
                      <label class="col-sm-3 col-form-label">ID del Estudiante</label>
                      <div class="col-sm-9">
                        <input placeholder="ID del estudiante" disabled="" class="form-control" type="text" name="id" id="inputText" value="<?php echo $id_estudiante ?>">
                      </div>
                    </div>
                    
                    <div class="form-group row" align="Left">
                      <label class="col-sm-3 col-form-label">Documento</label>
                      <div class="col-sm-9">
                        <input placeholder="Documento" class="form-control" type="text" name="documento_usuario" id="inputText" value="<?php echo $doc ?>">
                      </div>
                    </div>
                    
                    <div class="form-group row" align="Left">
                      <label class="col-sm-3 col-form-label">Nombres</label>
                      <div class="col-sm-9">
                        <input placeholder="Nombres" class="form-control" type="text" name="nombre_usuario" id="inputText" value="<?php echo $nombre ?>">
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-3 col-form-label">Apellidos</label>
                      <div class="col-sm-9">
                        <input placeholder="Apellidos" class="form-control" type="text" name="apellido_usuario" id="inputText" value="<?php echo $apellido ?>">
                      </div>
                    </div>
                    
                    <div class="form-group row" align="Left">
                      <label class="col-sm-3 col-form-label">Semestre</label>
                      <div class="col-sm-9">
                        <input placeholder="Semestre" class="form-control" type="text" name="Semestre" id="inputText" value="<?php echo $semestre ?>">
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-3 col-form-label">Clave</label>
                      <div class="col-sm-9">
                        <input placeholder="Clave" class="form-control" type="text" name="clave" id="inputText" value="<?php echo $clave ?>">
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-3 col-form-label">Correo</label>
                      <div class="col-sm-9">
                        <input placeholder="Correo" class="form-control" type="text" name="correo" id="inputText" value="<?php echo $correo ?>">
                      </div>
                    </div>

                    <fieldset>
                      <label>Tipo de usuario</label>
                      <select class="form-control " name="tipousuario" required>
                        <option value="0" disabled="">Seleccione:</option>
                        <?php
                        //ciclo while 
                        while ($resultado = mysqli_fetch_assoc($seleccionUsuario)) {
                        ?>
                          <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                          <option value="<?php echo $resultado['id_tipo_usuario'] ?>"><?php echo $resultado['nombre'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </fieldset>
                    <br>
                   
                    <fieldset>
                      <label>Carrera: </label>
                      <select name="carrera" class="form-control">
                        <option value="0" disabled="">Seleccione:</option>
                        <?php
                        //se hace el recorrido de la consulta establecida en la parte superior para mostrar los datos en el respectivo select
                        while ($valores1 = mysqli_fetch_assoc($seleccioncarrera)) {
                        ?>
                          <!--se traen los datos a mostrar en el select-->
                          <option value="<?php echo $valores1['id_carrera'] ?>"><?php echo $valores1['nombre'] ?></option>';
                        <?php
                        }
                        ?>

                      </select>
                    </fieldset>
                    <br>

                    <fieldset>
                      <label>Jornada: </label><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Diurna" required="">
                        <label class="form-check-label" for="inlineRadio1">Diurna</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Nocturna">
                        <label class="form-check-label" for="inlineRadio2">Nocturna</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="Sabatina">
                        <label class="form-check-label" for="inlineRadio3">Sabatina</label>
                      </div>
                    </fieldset>
                    <br>
                    
                    <fieldset>
                      <button name="enviar" type="submit" id="contact-submit" data-submit="...Sending" class="col-3" style="background-color: green;color:white;border:black;" >Actualizar</button>
                    </fieldset>
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