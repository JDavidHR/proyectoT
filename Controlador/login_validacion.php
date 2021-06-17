<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="css/style_login.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="col-lg-offset-3 col-lg-6">
    <?php
    // valido si existen las variables del login y si estan vacias
    if(isset($_POST['doc']) && isset($_POST['pass']) && isset($_POST['tipousuario']) && 
            !empty($_POST['doc']) && !empty($_POST['pass']) && !empty($_POST['tipousuario']) ){
        //llamo el archivo de conexion de la bd
        require_once '../Modelo/MySQL.php';
        
        //lleno las variables
        $usuario = $_POST['doc'];
        $pass = $_POST['pass'];
        $tipousuario = $_POST['tipousuario'];
        //instancio la clase MySQL
        $mysql = new MySQL;
        //llamo la funcion de conectar a la BD
        $mysql->conectar();
        //pregunto si el tipo usuario es 1 = Medico
        if($tipousuario == 1){
            //Consulto si existe un usuario con ese estado
            $ConsultarEstado = $mysql->efectuarConsulta("select asistencia.estudiante.estado from estudiante where documento = ".$usuario." and clave = '".$pass."'");
            //Pregunto si la consulta esta vacia
            if(!empty($ConsultarEstado)){
                //Consulto si el numero de filas es mayor a 0 
                if(mysqli_num_rows($ConsultarEstado) > 0){
                    //recorro el objeto de la consulta
                    while ($resultado = mysqli_fetch_assoc($ConsultarEstado)){
                        //almaceno los resultados en variables
                        $estado = $resultado["estado"];
                    }
                    //si estado es = 1 el usuario esta activo
                    if($estado == 1){
                        //realizo la consulta para ver si existe un usuario en la bd y esta activo
                        $usuarios= $mysql->efectuarConsulta("select asistencia.estudiante.id_estudiante, asistencia.estudiante.nombres, asistencia.estudiante.tipo_usuario_id_tipo_usuario from estudiante where documento = ".$usuario." and clave = '".$pass."' and estado = 1"); 
                        //Cuento si la consulta esta vacia
                        if (!empty($usuarios)){
                            //consulto si existen filas en el objeto
                            if(mysqli_num_rows($usuarios) > 0){
                                //inicio la session
                                session_start();
                                //recorro el resultado de la consulta y la almaceno en una variable
                                while ($resultado= mysqli_fetch_assoc($usuarios)){
                                    //almaceno los resultados en variables
                                    $id_estudiante = $resultado["id_estudiante"];
                                    $nombre = $resultado["nombres"];
                                    $tipo_usuario = $resultado['tipo_usuario_id_tipo_usuario'];
                                }
                                // Almaceno las variables en sesiones
                                $_SESSION['idEstudiante'] = $id_estudiante;
                                $_SESSION['nombre'] = $nombre;
                                $_SESSION['tipousuario'] = $tipo_usuario;
                                 //redirecciono al index
                                header("Location: ../index_estudiante.php");
                            }else{
                                //Mesanje de error por si no hay filas en la consulta
                                echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>Usuario o contraseña incorrecta o esta inactivo.</div>";
                                header( "refresh:3;url=../login.php" );
                            }                                    
                        }else{
                            //Mensaje de error si la consulta esta vacia
                            echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>Usuario o contraseña incorrecta o esta inactivo.</div>";
                            header( "refresh:3;url=../login.php" ); 
                        } 
                    }else{
                        //Mensaje de error si el usuario esta desactivado
                        echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>El usuario esta inactivo.</div>";
                        header( "refresh:3;url=../login.php" ); 
                    }      
                }else{
                    //Mensaje de error si la consulta del estado no tiene filas
                    echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>Usuario o contraseña incorrecta.</div>";
                    header( "refresh:3;url=../login.php" ); 
                }                    
            }else{
                //Mensaje de error si la consulta del estado esta vacio
                echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>No existe el usuario.</div>";
                header( "refresh:3;url=../login.php" ); 
            }            
           //pregunto si el tipo usuario es 2 = paciente 
        }elseif($tipousuario == 2){
            //Consulto si existe un usuario con ese estado
            $ConsultarEstado = $mysql->efectuarConsulta("select asistencia.docente.estado from docente where documento = ".$usuario." and clave = '".$pass."'");
            //Pregunto si la consulta esta vacia
            if(!empty($ConsultarEstado)){
                //Consulto si el numero de filas es mayor a 0 
                if(mysqli_num_rows($ConsultarEstado) > 0){
                    //recorro el objeto de la consulta
                    while ($resultado = mysqli_fetch_assoc($ConsultarEstado)){
                        //almaceno los resultados en variables
                        $estado = $resultado["estado"];
                    }
                    //si estado es = 1 el usuario esta activo
                    if($estado == 1){
                        //realizo la consulta para ver si existe un usuario en la bd y esta activo
                        $usuarios= $mysql->efectuarConsulta("select asistencia.docente.id_docente, asistencia.docente.nombres, asistencia.docente.tipo_usuario_id_tipo_usuario from docente where documento = ".$usuario." and clave = '".$pass."' and estado = 1"); 
                        //Cuento si la consulta esta vacia
                        if (!empty($usuarios)){
                            //consulto si existen filas en el objeto
                            if(mysqli_num_rows($usuarios) > 0){
                                //inicio la session
                                session_start();
                                //recorro el resultado de la consulta y la almaceno en una variable
                                while ($resultado= mysqli_fetch_assoc($usuarios)){
                                    //almaceno los resultados en variables
                                    $id_docente = $resultado["id_docente"];
                                    $nombre = $resultado["nombres"];
                                    $tipo_usuario = $resultado['tipo_usuario_id_tipo_usuario'];
                                }
                                // Almaceno las variables en sesiones
                                $_SESSION['idDocente'] = $id_docente;
                                $_SESSION['nombre'] = $nombre;
                                $_SESSION['tipousuario'] = $tipo_usuario;
                                 //redirecciono al index
                                header("Location: ../index_docente.php");
                            }else{
                                //Mesanje de error por si no hay filas en la consulta
                                echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>Usuario o contraseña incorrecta o esta inactivo.</div>";
                                header( "refresh:3;url=../login.php" );
                            }                                    
                        }else{
                            //Mensaje de error si la consulta esta vacia
                            echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>Usuario o contraseña incorrecta o esta inactivo.</div>";
                            header( "refresh:3;url=../login.php" ); 
                        } 
                    }else{
                        //Mensaje de error si el usuario esta desactivado
                        echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>El usuario esta inactivo.</div>";
                        header( "refresh:3;url=../login.php" ); 
                    }      
                }else{
                    //Mensaje de error si la consulta del estado no tiene filas
                    echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>Usuario o contraseña incorrecta.</div>";
                    header( "refresh:3;url=../login.php" ); 
                }                    
            }else{
                //Mensaje de error si la consulta del estado esta vacio
                echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>No existe el usuario.</div>";
                header( "refresh:3;url=../login.php" ); 
            }            
           //pregunto si el tipo usuario es 2 = paciente 
        }elseif($tipousuario == 3){
            //Consulto si existe un usuario con ese estado
            $ConsultarEstado = $mysql->efectuarConsulta("select asistencia.administrador.estado from administrador where documento = ".$usuario." and clave = '".$pass."'");
            //Pregunto si la consulta esta vacia
            if(!empty($ConsultarEstado)){
                //Consulto si el numero de filas es mayor a 0 
                if(mysqli_num_rows($ConsultarEstado) > 0){
                    //recorro el objeto de la consulta
                    while ($resultado = mysqli_fetch_assoc($ConsultarEstado)){
                        //almaceno los resultados en variables
                        $estado = $resultado["estado"];
                    }
                    //si estado es = 1 el usuario esta activo
                    if($estado == 1){
                        //realizo la consulta para ver si existe un usuario en la bd y esta activo
                        $usuarios= $mysql->efectuarConsulta("select asistencia.administrador.id_administrador, asistencia.administrador.nombres, asistencia.administrador.tipo_usuario_id_tipo_usuario from administrador where documento = ".$usuario." and clave = '".$pass."' and estado = 1"); 
                        //Cuento si la consulta esta vacia
                        if (!empty($usuarios)){
                            //consulto si existen filas en el objeto
                            if(mysqli_num_rows($usuarios) > 0){
                                //inicio la session
                                session_start();
                                //recorro el resultado de la consulta y la almaceno en una variable
                                while ($resultado= mysqli_fetch_assoc($usuarios)){
                                    //almaceno los resultados en variables
                                    $id_administrador = $resultado["id_administrador"];
                                    $nombre = $resultado["nombres"];
                                    $tipo_usuario = $resultado['tipo_usuario_id_tipo_usuario'];
                                }
                                // Almaceno las variables en sesiones
                                $_SESSION['idAdministrador'] = $id_administrador;
                                $_SESSION['nombre'] = $nombre;
                                $_SESSION['tipousuario'] = $tipo_usuario;
                                 //redirecciono al index
                                header("Location: ../index_administrador.php");
                            }else{
                                //Mesanje de error por si no hay filas en la consulta
                                echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login_teatro.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>Usuario o contraseña incorrecta o esta inactivo.</div>";
                                header( "refresh:3;url=../login_teatro.php" );
                            }                                    
                        }else{
                            //Mensaje de error si la consulta esta vacia
                            echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>Usuario o contraseña incorrecta o esta inactivo.</div>";
                            header( "refresh:3;url=../login.php" ); 
                        } 
                    }else{
                        //Mensaje de error si el usuario esta desactivado
                        echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>El usuario esta inactivo.</div>";
                        header( "refresh:3;url=../login.php" ); 
                    }      
                }else{
                    //Mensaje de error si la consulta del estado no tiene filas
                    echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>Usuario o contraseña incorrecta.</div>";
                    header( "refresh:3;url=../login.php" ); 
                }                    
            }else{
                //Mensaje de error si la consulta del estado esta vacio
                echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>No existe el usuario.</div>";
                header( "refresh:3;url=../login.php" ); 
            }            
           //pregunto si el tipo usuario es 2 = paciente 
        }
        //Desconecto la conexion de la bD
        $mysql->desconectar();          
    }else{
        echo "<div class=\"alert alert-warning alert-dismissible\"><a href=\"../login.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Alerta!</strong>No se enviaron los datos.</div>";
        header( "refresh:3;url=../login.php" );
    }   
?>
  </div>
  <!-- Llamado de los respectivos scripts -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>
    
    

