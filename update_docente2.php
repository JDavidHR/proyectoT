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
                $id_docente = $_GET['id_docente'];
                $mostrardatos = $mysql->efectuarConsulta("SELECT asistencia.docente.documento,asistencia.docente.nombres,asistencia.docente.apellidos,asistencia.docente.clave,asistencia.docente.correo,asistencia.docente.tipo_usuario_id_tipo_usuario from docente WHERE asistencia.docente.id_docente = " . $id_docente . "");

        $seleccionUsuario = $mysql->efectuarConsulta("SELECT asistencia.tipo_usuario.id_tipo_usuario, asistencia.tipo_usuario.nombre from tipo_usuario where asistencia.tipo_usuario.id_tipo_usuario = 2");
        //se inicia el recorrido para mostrar los datos de la BD
        while ($valores1 = mysqli_fetch_assoc($mostrardatos)) {
            //declaracion de variables
            $doc = $valores1['documento'];
            $nombre = $valores1['nombres'];
            $apellido = $valores1['apellidos'];
            $pass = $valores1['clave'];
            $correo = $valores1['correo'];
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
                            
                            <form id="contact" action="Controlador/administrador/update_docente.php?id=<?php echo $id_docente; ?>" method="post">
                            <b>
                                <p >Actualizar Docente</p>
                            </b>    
                            <div class="form-group row" align="Left">
                               
                                              <label class="col-sm-3 col-form-label">Id del Docente</label>
                                              <div class="col-sm-9">
                                                <input placeholder="ID docente" disabled="" class="form-control" type="text" name="id" id="inputText" value="<?php echo $id_docente ?>">
                                              </div>
                                            </div>

                                            <div class="form-group row" align="Left">
                                              <label class="col-sm-3 col-form-label">Documento</label>
                                              <div class="col-sm-9">
                                                <input placeholder="Documento" class="form-control" type="text" name="documento_docente" id="inputText" value="<?php echo $doc ?>">
                                              </div>
                                            </div>
                                            
                                            <div class="form-group row" align="Left">
                                              <label class="col-sm-3 col-form-label">Nombres</label>
                                              <div class="col-sm-9">
                                                <input placeholder="Nombres" class="form-control" type="text" name="nombre_docente" id="inputText" value="<?php echo $nombre ?>">
                                              </div>
                                            </div>

                                            <div class="form-group row" align="Left">
                                              <label class="col-sm-3 col-form-label">Apellidos</label>
                                              <div class="col-sm-9">
                                                <input placeholder="Apellidos" class="form-control" type="text" name="apellido_docente" id="inputText" value="<?php echo $apellido ?>">
                                              </div>
                                            </div>

                                            <div class="form-group row" align="Left">
                                              <label class="col-sm-3 col-form-label">Clave</label>
                                              <div class="col-sm-9">
                                                <input placeholder="Clave" class="form-control" type="text" name="contrasena" id="inputText" value="<?php echo $pass ?>">
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