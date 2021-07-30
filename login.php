<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<meta http-equiv="X-UA-Compatible" content="ie=edge">-->
  <title>Bienvenido al sistema de login</title>
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <?php 
  session_start();
  if(!isset($_SESSION['tipousuario'])){
  //llamado del archivo mysql
  require_once 'Modelo/MySQL.php';
  //creacion de nueva "consulta"
  $mysql = new MySQL;
  //se conecta a la base de datos
  $mysql->conectar();    
  //respectiva consulta para la seleccion de usuario
  $seleccionUsuario = $mysql->efectuarConsulta("SELECT asistencia.tipo_usuario.id_tipo_usuario, asistencia.tipo_usuario.nombre from tipo_usuario");     
  //se desconecta de la base de datos
  $mysql->desconectar();    
  ?>

  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-7">
            <img src="assets/images/login.png" alt="login" class="login-card-img">
          </div>
          <div class="col-md-5">
            <div class="card-body">
              <p class="login-card-description">Bienvenid@, por favor ingrese los datos correspondientes</p>
              <form action="#!">
                  <div class="form-group">
                    <label>Documento</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="No. de Documento" required="">
                  </div>
                  <div class="form-group ">
                    <label>Clave</label>                
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********" required="">
                  </div>
                  <div class="form-group mb-4">
                      <select class="form-control " name="tipousuario" required>
                        <?php 
                        //ciclo while que nos sirve para traer cuales son los tipos de usuario (paciente, medico)
                          while ($resultado= mysqli_fetch_assoc($seleccionUsuario)){                         
                        ?> 
                        <!-- se imprimen los datos en un select segun el respectivo id o nombre -->
                            <option value="<?php echo $resultado['id_tipo_usuario']?>"><?php echo $resultado['nombre']?></option>                                                
                        <?php
                          }
                        ?>
                      </select>
                  </div>
                  <input name="sesion" id="sesion" class="btn btn-block login-btn mb-4" type="submit" value="Iniciar sesi&oacute;n">
                </form>

                <a href="#!" class="forgot-password-link">¿Olvidaste tu clave o no tienes una a&uacute;n?</a>
                <br><br>

                <nav class="login-card-footer-nav">
                  <div class="d-flex align-items-center justify-content-between small">
                      <div class="text-muted">Copyright &copy; Asistencia estudiantil - Derechos reservados</div>
                  </div>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php
    }else{
         header( "refresh:0;url=index.php" );    
    }
  ?>
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
