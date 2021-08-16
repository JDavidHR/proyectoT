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
    $seleccionaula = $mysql->efectuarConsulta("SELECT asistencia.aula.id_aula,asistencia.aula.nombre from aula where estado = 1");
    $selecciondia = $mysql->efectuarConsulta("SELECT asistencia.dias.id_dia, asistencia.dias.nombre as nombredia from dias ORDER BY id_dia");
    $seleccionmateria = $mysql->efectuarConsulta("SELECT asistencia.materia.id_materia,asistencia.materia.nombre from materia where estado = 1");
    $selecciongrupo = $mysql->efectuarConsulta("SELECT asistencia.grupo.id_grupo, asistencia.grupo.nombre from grupo where estado = 1");
    $selecciondocente = $mysql->efectuarConsulta("SELECT asistencia.docente.id_docente, asistencia.docente.nombres as nombredocente, asistencia.docente.apellidos from docente where estado = 1");
                
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
                           
                                <form id="contact" action="Controlador/administrador/insertar_clase.php" method="post">
                                <b>
                                <p class="mb-4">Registrar Clase</p>
                                <p class="mb-4">Recuerda llenar todos los campos.</p>
                            </b>
                            <div class="form-group row" align="Left">
                      <label class="col-sm-4 col-form-label">Selecciona el día:</label>
                      <div class="col-sm-8">
                        <select class="form-control " name="dia" required>
                          <option value="0" disabled="">Seleccione:</option>
                          <?php
                          //ciclo while 
                          while ($resultado = mysqli_fetch_assoc($selecciondia)) {
                          ?>
                            <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                            <option value="<?php echo $resultado['id_dia'] ?>"><?php echo $resultado['nombredia'] ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-4 col-form-label">Hora inicio: </label>
                      <div class="col-sm-8">
                        <input type="time" name="hora" class="form-control" min="07:00:00" max="22:00:00" required="">
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-4 col-form-label">Hora fin: </label>
                      <div class="col-sm-8">
                        <input type="time" name="horafin" class="form-control" min="07:00:00" max="22:00:00" required="">
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-4 col-form-label">Codigo de la clase: </label>
                      <div class="col-sm-8">
                        <input placeholder="..." class="form-control" type="text" name="codigo" id="inputText" required="">
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-4 col-form-label">Docente:</label>
                      <div class="col-sm-8">
                        <select class="form-control " name="nombre_docente" required>
                          <option value="0" disabled="">Seleccione:</option>
                          <?php
                          //ciclo while 
                          while ($resultado = mysqli_fetch_assoc($selecciondocente)) {
                          ?>
                            <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                            <option value="<?php echo $resultado['id_docente'] ?>"><?php echo $resultado['nombredocente']. " ". $resultado['apellidos']?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-4 col-form-label">Aula:</label>
                      <div class="col-sm-8">
                        <select class="form-control " name="aula" required>
                          <option value="0" disabled="">Seleccione:</option>
                          <?php
                          //ciclo while 
                          while ($resultado = mysqli_fetch_assoc($seleccionaula)) {
                          ?>
                            <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                            <option value="<?php echo $resultado['id_aula'] ?>"><?php echo $resultado['nombre'] ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-4 col-form-label">Materia:</label>
                      <div class="col-sm-8">
                        <select class="form-control " name="materia" required>
                          <option value="0" disabled="">Seleccione:</option>
                          <?php
                          //ciclo while 
                          while ($resultado = mysqli_fetch_assoc($seleccionmateria)) {
                          ?>
                            <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                            <option value="<?php echo $resultado['id_materia'] ?>"><?php echo $resultado['nombre'] ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row" align="Left">
                      <label class="col-sm-4 col-form-label">Grupo:</label>
                      <div class="col-sm-8">
                        <select name="grupo" class="form-control">
                            <option value="0" disabled="">Seleccione:</option>
                            <?php
                            //se hace el recorrido de la consulta establecida en la parte superior para mostrar los datos en el respectivo select
                            while ($resultado = mysqli_fetch_assoc($selecciongrupo)) {
                            ?>
                              <!--se traen los datos a mostrar en el select-->
                              <option value="<?php echo $resultado['id_grupo'] ?>"><?php echo $resultado['nombre'] ?></option>
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