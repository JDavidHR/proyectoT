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
                $id_clase = $_GET['id_clase'];


        $mostrardatos = $mysql->efectuarConsulta("SELECT asistencia.clase.hora, asistencia.clase.horafin, asistencia.clase.Materia_id_materia, asistencia.materia.nombre as materianombre, asistencia.clase.Aula_id_aula, asistencia.aula.nombre as aulanombre, asistencia.clase.codigo, asistencia.dias.id_dia, asistencia.dias.nombre as nombredia, asistencia.docente.id_docente, docente.nombres, clase.Grupo_id_grupo, grupo.nombre as grupo from clase join dias on dias.id_dia = clase.Dias_id_dia join docente on docente.id_docente = clase.Docente_id_docente join aula on asistencia.clase.Aula_id_aula = asistencia.aula.id_aula join materia on asistencia.clase.materia_id_materia = asistencia.materia.id_materia join grupo on clase.Grupo_id_grupo = grupo.id_grupo WHERE asistencia.clase.id_clase = " . $id_clase . " GROUP by asistencia.clase.grupo_id_grupo");


        //se desconecta de la base de datos
        while ($valores1 = mysqli_fetch_assoc($mostrardatos)) {
            //declaracion de variables
            $hora = $valores1['hora'];
            $horafin = $valores1['horafin'];
            $materia = $valores1['Materia_id_materia'];
            $materianombre = $valores1['materianombre'];
            $aula = $valores1['Aula_id_aula'];
            $codigo = $valores1['codigo'];
            $dia = $valores1['nombredia'];
            $id_dia = $valores1['id_dia'];
            $docente = $valores1['nombres'];
            $id_docente = $valores1['id_docente'];
            $aulanombre = $valores1['aulanombre'];
            $id_grupo = $valores1['Grupo_id_grupo']; //
            $grupo = $valores1['grupo'];
        }

        //respectiva consulta para la seleccion de usuario
        $seleccionaula = $mysql->efectuarConsulta("SELECT asistencia.aula.id_aula,asistencia.aula.nombre from aula where estado = 1");
        $seleccionmateria = $mysql->efectuarConsulta("SELECT asistencia.materia.id_materia,asistencia.materia.nombre from materia where estado = 1");
        $selecciondia = $mysql->efectuarConsulta("SELECT asistencia.dias.id_dia, asistencia.dias.nombre as nombredia from dias");
        $selecciongrupo = $mysql->efectuarConsulta("SELECT asistencia.grupo.id_grupo, asistencia.grupo.nombre, asistencia.grupo.estado from grupo where estado = 1");
        $selecciondocente = $mysql->efectuarConsulta("SELECT asistencia.docente.id_docente, asistencia.docente.nombres as nombredocente from docente where estado = 1");
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
                            
                            <form id="contact" action="Controlador/administrador/update_clase.php?id=<?php echo $id_clase; ?>" method="post">
                            <b>
                                <p >Actualizar Clase</p>
                            </b>    
                            <div class="form-group row" align="Left">
                                          <label class="col-sm-4 col-form-label">Id del horario: </label>
                                          <div class="col-sm-8">
                                            <input placeholder="Id del horario" class="form-control" type="text" disabled="" name="id" id="inputText" value="<?php echo $id_clase ?>">
                                          </div>
                                        </div>

                                        <div class="form-group row" align="Left">
                                          <label class="col-sm-4 col-form-label">Selecciona el día:</label>
                                          <div class="col-sm-8">
                                            <select class="form-control " name="dia" required>
                                                <option value="<?php echo $id_dia?>" selected="true"><?php echo $dia?></option>
                                                <option disabled>Seleccione un dia si va a editar</option>
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
                                            <input type="time" name="hora" class="form-control" min="07:00:00" max="22:00:00" value="<?php echo $hora ?>">
                                          </div>
                                        </div>

                                        <div class="form-group row" align="Left">
                                          <label class="col-sm-4 col-form-label">Hora fin: </label>
                                          <div class="col-sm-8">
                                            <input type="time" name="horafin" class="form-control" min="07:00:00" max="22:00:00" value="<?php echo $horafin ?>">
                                          </div>
                                        </div>

                                        <div class="form-group row" align="Left">
                                          <label class="col-sm-4 col-form-label">Codigo de la clase: </label>
                                          <div class="col-sm-8">
                                            <input placeholder="Codigo de la clase" class="form-control" type="text" name="codigo" id="inputText" value="<?php echo $codigo ?>">
                                          </div>
                                        </div>

                                        <div class="form-group row" align="Left">
                                          <label class="col-sm-4 col-form-label">Docente:</label>
                                          <div class="col-sm-8">
                                            <select class="form-control " name="nombre_docente" required>
                                                <option value="<?php echo $id_docente?>" selected="true"><?php echo $docente?></option>
                                                <option disabled>Seleccione un docente si va a editar</option>
                                                <?php
                                                //ciclo while 
                                                while ($resultado = mysqli_fetch_assoc($selecciondocente)) {
                                                ?>
                                                  <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                                                  <option value="<?php echo $resultado['id_docente'] ?>"><?php echo $resultado['nombredocente'] ?></option>
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
                                                <option value="<?php echo $aula?>" selected="true"><?php echo $aulanombre?></option>
                                                <option disabled>Seleccione una aula si va a editar</option>
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
                                                <option value="<?php echo $materia?>" selected="true"><?php echo $materianombre?></option>
                                                <option disabled>Seleccione una materia si va a editar</option>
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
                                                <option value="<?php echo $id_grupo?>" selected="true"><?php echo $grupo?></option>
                                                <option disabled>Seleccione un grupo si va a editar</option>
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

                                        <br>
                                        <fieldset>
                                            <button name="enviar" type="submit" id="contact-submit" data-submit="...Sending" class="col-3">Actualizar</button>
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