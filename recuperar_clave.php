<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<meta http-equiv="X-UA-Compatible" content="ie=edge">-->
  <title>Recuperar clave</title>
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION['tipousuario'])) {
    header("refresh:0;url=index.php");
  } else {
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
                <label>Recuerde no compartir los datos con nadie.</label><br><br>
                <form action="Controlador/recuperar_password.php" method="POST">
                  <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo electr&oacute;nico" required="">
                  </div>
                  <div class="form-group ">
                    <label>Nueva clave</label>
                    <input type="password" name="pass" id="pass" class="form-control" placeholder="***********" required="">
                  </div>
                  <div class="form-group mb-4">
                    <select class="form-control" name="tipousuario" required>
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
                  </div>
                  <center>
                    <input name="enviar" class="btn login-btn col-5" type="submit" value="Recuperar">
                    <a href="login.php"><input class="btn login-btn col-5" style="background: #D33E3E" value="Cancelar"></a>
                  </center>

                </form>

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
  }
  ?>
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>