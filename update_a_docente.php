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
        $id_docente = $_SESSION['idDocente'];
        $clase = $_GET['ida_docente'];

        $datosdocente = $mysql->efectuarConsulta("SELECT docente.id_docente, docente.nombres, docente.documento, docente.tipo_usuario_id_tipo_usuario, tipo_usuario.nombre from docente join tipo_usuario on tipo_usuario.id_tipo_usuario = docente.tipo_usuario_id_tipo_usuario where docente.id_docente = " . $id_docente . "");
  while ($valores1 = mysqli_fetch_assoc($datosdocente)) {
    $documento = $valores1['documento'];
    $nombres = $valores1['nombres'];
    $tipo_usuario = $valores1['nombre'];
  }

  $MostrarDatos = $mysql->efectuarConsulta("SELECT asistencia.a_docente.ida_docente, asistencia.a_docente.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre as nombremateria, asistencia.grupo.id_grupo, asistencia.grupo.nombre as nombregrupo, asistencia.a_docente.fecha, asistencia.clase.codigo, asistencia.links.links, asistencia.a_docente.estado FROM a_docente JOIN asistencia.clase ON asistencia.a_docente.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo JOIN asistencia.links ON asistencia.a_docente.clase_id_clase = asistencia.links.clase_id_clase WHERE asistencia.a_docente.estado = 'Activa' AND asistencia.a_docente.estado2 = 1 AND asistencia.a_docente.ida_docente = ".$clase." GROUP BY asistencia.materia.nombre");

  //se inicia el recorrido para mostrar los datos de la BD

  while ($valores1 = mysqli_fetch_assoc($MostrarDatos)) {
    //declaracion de variables
    $nombremateria = $valores1['nombremateria'];
    $idMateria = $valores1['Materia_id_materia'];
    $codigo = $valores1['codigo'];
    $grupo = $valores1['nombregrupo'];
    $idgrupo = $valores1['id_grupo'];
    $links = $valores1['links'];
    $fecha = $valores1['fecha'];
    $id_clase = $valores1['clase_id_clase'];
  }

  $listaEA = $mysql->efectuarConsulta("SELECT asistencia.clase.id_clase, asistencia.grupo.id_grupo, asistencia.grupo.nombre, asistencia.clase.Docente_id_docente, asistencia.estudiante.nombres, asistencia.estudiante.apellidos, asistencia.estudiante.documento, asistencia.a_estudiante.asistio, asistencia.clase.Grupo_id_grupo from grupo JOIN clase ON asistencia.grupo.id_grupo = asistencia.clase.Grupo_id_grupo JOIN estudiante ON asistencia.grupo.Estudiante_id_estudiante = asistencia.estudiante.id_estudiante JOIN asistencia.a_estudiante ON asistencia.a_estudiante.estudiante_id_estudiante = asistencia.estudiante.id_estudiante WHERE asistencia.clase.id_clase = ". $id_clase ." AND asistencia.clase.Docente_id_docente = ". $id_docente ."");
        }
        $mysql->desconectar();
        //Si el usuario es un estudiante
        if($_SESSION['tipousuario'] == 2){
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
                                                <td><?php echo $nombres." ".$apellidos ?></td>
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
                            <div class="col-md-8 col-md-offset-3">
                            <form id="contact" action="Controlador/docente/newcode.php" method="post">
                    <!--<h3><?php echo "Clase: " . $nombremateria . "<br>Codigo generado: " . $codigo ?></h3>-->
                    <h3>Datos de la clase</h3>
                    <br>

                    <div class="form-group row" align="right">
                      <label class="col-sm-5 col-form-label">Clase seleccionada:</label>
                      <div class="col-sm-5">
                        <select class="form-control " id="newcodeidmateria" name="newcodeidmateria" required>
                          <option value="<?php echo $idMateria ?>"><?php echo $nombremateria ?></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row" align="right">
                      <label class="col-sm-5 col-form-label">Codigo:</label>
                      <div class="col-sm-5">
                        <fieldset>
                          <input placeholder="Codigo" disabled="" class="form-control" type="text" name="codigo" id="inputText" value="<?php echo $codigo ?>">
                        </fieldset>
                      </div>
                    </div>
                  </form>
                            </div>
                            </center>
                        </div>
                        <br><br>
                        
                        <center>
                            <b><p class="mb-4">Listado de estudiantes</p></b>
                        </center>
                        <div class="row">
                            <center>
                            <div class="col-md-8 col-md-offset-3">
                                <table id="" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                        <th scope="col">Numero de documento</th>
                                        <th scope="col">Nombre del estudiante</th>
                                        <th scope="col">Asistio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            while ($valores3 = mysqli_fetch_assoc($listaEA)) {
                                            ?>
                                                <td><?php echo $valores3['documento'] ?></td>
                                                <td><?php echo $valores3['nombres']." ".$valores3['apellidos'] ?></td>
                                                <td><?php echo $valores3['asistio'] ?></td>
                                        </tr>
                                    <?php
                                            }
                                    ?>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            </center>
                        


                        <form id="contact" action="Controlador/docente/updateasistenciaDocente.php" method="post">
                  <div class="container col-md-7 col-md-offset-3" style="text-align: center">
                    <center>
                      <h3>Links y/o comentarios a la clase adjuntados</h3>
                    </center>

                    <div class="form-group row">
                      <fieldset>
                        <textarea name="comentarios" rows="5" cols="70" required="" placeholder="Escribe aquí una descripción..." ><?php echo $links ?></textarea>
                      </fieldset>
                    </div>

                    <div class="form-group row" align="right">
                      <label class="col-sm-5 col-form-label">Id de la clase:</label>
                      <div class="col-sm-5">
                        <select class="form-control " id="idclaseimprimir" name="idclaseimprimir" required>
                          <option value="<?php echo $id_clase ?>"><?php echo $id_clase ?></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row" align="right">
                      <label class="col-sm-5 col-form-label">Fecha de registro:</label>
                      <div class="col-sm-5">
                          <input type="date" name="fechaclase" class="form-control" required="" value="<?php echo $fecha ?>">
                      </div>
                    </div>

                    <br>
                    <fieldset>
                      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-5" style="background-color: green;color:white;border:black;">Guardar y actualizar</button>
                    </fieldset>
                  </div>
                </form>
                
                </div>
                    </div>
                </main>
                <br><br>
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
