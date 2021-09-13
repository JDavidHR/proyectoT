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
                $seleccionUsuario = $mysql->efectuarConsulta("SELECT asistencia.tipo_usuario.id_tipo_usuario, asistencia.tipo_usuario.nombre from tipo_usuario where asistencia.tipo_usuario.id_tipo_usuario = 1");
              
              $seleccioncarrera = $mysql->efectuarConsulta("SELECT asistencia.carrera.id_carrera, asistencia.carrera.nombre from carrera where estado = 1");
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
                        <div class="container col-md-6 col-md-offset-3" style="text-align: center">
                          <form id="contact" action="Controlador/insertar_usuario.php" method="post">
                            <h3>Registrar Estudiante</h3>
                            <label>Recuerda llenar todos los campos</label>
                            <br><br>

                            <div class="form-group row" align="Left">
                              <label class="col-sm-3 col-form-label">Documento</label>
                              <div class="col-sm-9">
                                <input placeholder="..." class="form-control" type="text" name="documento_usuario" id="inputText" required="">
                              </div>
                            </div>
                            
                            <div class="form-group row" align="Left">
                              <label class="col-sm-3 col-form-label">Nombres</label>
                              <div class="col-sm-9">
                                <input placeholder="..." class="form-control" type="text" name="nombre_usuario" id="inputText" required="">
                              </div>
                            </div>

                            <div class="form-group row" align="Left">
                              <label class="col-sm-3 col-form-label">Apellidos</label>
                              <div class="col-sm-9">
                                <input placeholder="..." class="form-control" type="text" name="apellido_usuario" id="inputText" required="">
                              </div>
                            </div>
                            
                            <div class="form-group row" align="Left">
                              <label class="col-sm-3 col-form-label">Semestre</label>
                              <div class="col-sm-9">
                                <input placeholder="..." class="form-control" type="text" name="Semestre" id="inputText" required="">
                              </div>
                            </div>

                            <div class="form-group row" align="Left">
                              <label class="col-sm-3 col-form-label">Clave</label>
                              <div class="col-sm-9">
                                <input placeholder="***" class="form-control" type="text" name="clave" id="inputText" required="">
                              </div>
                            </div>

                            <div class="form-group row" align="Left">
                              <label class="col-sm-3 col-form-label">Correo</label>
                              <div class="col-sm-9">
                                <input placeholder="..." class="form-control" type="email" name="correo" id="inputText" required="">
                              </div>
                            </div>

                            <fieldset>
                              <label>Tipo de usuario: </label>
                              <center>
                                <select class="form-select col-md-8 col-md-offset-1" name="tipousuario" required="">
                                  <option value="0" disabled="">Seleccione:</option>
                                  <?php
                                  //ciclo while que nos sirve para traer cuales son los tipos de usuario (paciente, medico)
                                  while ($resultado = mysqli_fetch_assoc($seleccionUsuario)) {
                                  ?>
                                    <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                                    <option value="<?php echo $resultado['id_tipo_usuario'] ?>"><?php echo $resultado['nombre'] ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </center>
                            </fieldset>
                            
                            <br>
                            <fieldset>
                              <label>Carrera: </label>
                              <center>
                                <select name="carrera" class="form-select col-md-8 col-md-offset-1" required="">
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
                              </center>
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
                              <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-3">Registrar</button>
                            </fieldset>
                            <br>
                          </form>
                        </div>

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