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
      $smateria3 = $_POST['materianombre'];
      $id = $_POST['selectgrupo'];


      $datosdocente = $mysql->efectuarConsulta("SELECT docente.id_docente, docente.nombres, docente.documento, docente.tipo_usuario_id_tipo_usuario, tipo_usuario.nombre from docente join tipo_usuario on tipo_usuario.id_tipo_usuario = docente.tipo_usuario_id_tipo_usuario where docente.id_docente = " . $id_docente . "");
      while ($valores1 = mysqli_fetch_assoc($datosdocente)) {
        $documento = $valores1['documento'];
        $nombres = $valores1['nombres'];
        $tipo_usuario = $valores1['nombre'];
      }


      $seleccionmateria = $mysql->efectuarConsulta("SELECT asistencia.docente.id_docente, materia.nombre, materia.id_materia from docente join clase on clase.Docente_id_docente = docente.id_docente join grupo on grupo.id_grupo = clase.Grupo_id_grupo join materia on materia.id_materia = clase.Materia_id_materia where clase.Materia_id_materia = " . $smateria3 . "");
      //se inicia el recorrido para mostrar los datos de la BD

      while ($valores1 = mysqli_fetch_assoc($seleccionmateria)) {
        //declaracion de variables
        $nombremateria = $valores1['nombre'];
        $idMateria = $valores1['id_materia'];
      }



      $selecciongrupo = $mysql->efectuarConsulta("SELECT asistencia.clase.Grupo_id_grupo, asistencia.grupo.nombre as nombregrupo FROM clase JOIN grupo on asistencia.grupo.id_grupo = asistencia.clase.Grupo_id_grupo WHERE asistencia.clase.Grupo_id_grupo = " . $id . " GROUP BY asistencia.clase.Grupo_id_grupo");
      while ($valores1 = mysqli_fetch_assoc($selecciongrupo)) {
        //declaracion de variables
        $grupo = $valores1['nombregrupo'];
        $idgrupo = $valores1['Grupo_id_grupo'];
      }

      $codigoclase = $mysql->efectuarConsulta("SELECT asistencia.clase.id_clase, asistencia.clase.codigo, asistencia.materia.nombre from clase join materia on asistencia.materia.id_materia = asistencia.clase.Materia_id_materia where clase.Materia_id_materia = " . $smateria3 . " and asistencia.clase.Grupo_id_grupo = " . $idgrupo . " and asistencia.clase.Docente_id_docente = " . $id_docente . "");
      while ($valores1 = mysqli_fetch_assoc($codigoclase)) {
        //declaracion de variables
        $codigo = $valores1['codigo'];
        $idclase = $valores1['id_clase'];
      }

      $listaE = $mysql->efectuarConsulta("SELECT asistencia.clase.id_clase, asistencia.grupo.id_grupo, asistencia.grupo.nombre, asistencia.clase.Docente_id_docente, asistencia.estudiante.nombres, asistencia.estudiante.apellidos, asistencia.estudiante.documento, asistencia.clase.Grupo_id_grupo from grupo JOIN clase ON asistencia.grupo.id_grupo = asistencia.clase.Grupo_id_grupo JOIN estudiante ON asistencia.grupo.Estudiante_id_estudiante = asistencia.estudiante.id_estudiante WHERE asistencia.clase.id_clase = " . $idclase . " AND asistencia.clase.Docente_id_docente = " . $id_docente . "");
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
                <form id="contact" action="Controlador/docente/newcode.php" method="post">
                  <h3><?php echo "Clase: " . $nombremateria . "<br>Codigo generado: " . $codigo ?></h3>
                  <br>

                  <div class="form-group row" align="right">
                    <label class="col-sm-5 col-form-label">Id de la clase:</label>
                    <div class="col-sm-5">
                      <select class="form-control " id="idclaseimprimir" name="idclaseimprimir" required>
                        <option value="<?php echo $idclase ?>"><?php echo $idclase ?></option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" align="right">
                    <label class="col-sm-5 col-form-label">Clase seleccionada:</label>
                    <div class="col-sm-5">
                      <select class="form-control " id="newcodeidmateria" name="newcodeidmateria" required>
                        <option value="<?php echo $idMateria ?>"><?php echo $nombremateria ?></option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" align="right">
                    <label class="col-sm-5 col-form-label">Nuevo codigo (Opcional):</label>
                    <div class="col-sm-5">
                      <fieldset>
                        <input class="form-control " name="newcode" placeholder="Nuevo Codigo">
                      </fieldset>
                    </div>
                  </div>
                  <br>

                  <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-5" style="background-color: green;color:white;border:black;">Generar nuevo</button>
                  </fieldset>
                </form>
              </div>
            </center>
          </div>
          <br><br>

          <center>
            <h3>Listado de estudiantes</h3>
            <div class="col-md-5 col-md-offset-3">
              <table id="" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">Numero de documentos</th>
                    <th scope="col">Nombres de los estudiantes</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    while ($valores3 = mysqli_fetch_assoc($listaE)) {
                    ?>
                      <td><?php echo $valores3['documento'] ?></td>
                      <td><?php echo $valores3['nombres'] . " " . $valores3['apellidos'] ?></td>
                  </tr>
                <?php
                    }
                ?>
                </tbody>
              </table>
            </div>
          </center>

          <br><br>
          <form id="contact" action="Controlador/docente/asistenciaDocente.php" method="post">
            <div class="container col-md-7 col-md-offset-3" style="text-align: center">
              <center>
                <h3>Espacio para adjuntar links y/o comentarios a la clase</h3>
              </center>

              <div class="form-group row">
                <fieldset>
                  <textarea name="comentarios" rows="5" cols="70" required="" placeholder="Escribe aquí una descripción..."></textarea>
                </fieldset>
              </div>

              <div class="form-group row" align="right">
                <label class="col-sm-5 col-form-label">Id de la clase:</label>
                <div class="col-sm-5">
                  <select class="form-control " id="idclaseimprimir" name="idclaseimprimir" required>
                    <option value="<?php echo $idclase ?>"><?php echo $idclase ?></option>
                  </select>
                </div>
              </div>

              <div class="form-group row" align="right">
                <label class="col-sm-5 col-form-label">Fecha de registro:</label>
                <div class="col-sm-5">
                  <input type="date" name="fechaclase" class="form-control" required="">
                </div>
              </div>

              <br>
              <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="col-5" style="background-color: green;color:white;border:black;">Guardar y registrar clase</button>
              </fieldset>
            </div>
          </form>
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
    } else {
      header("refresh:0;url=login.php");
    }
?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>

</html>