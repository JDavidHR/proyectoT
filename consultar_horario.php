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
        if (isset($_SESSION['idEstudiante'])) {
            $id_estudiante = $_SESSION['idEstudiante'];
            //respectiva consulta para la validacion de datos
            $datosestudiante = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, estudiante.documento, estudiante.nombres, estudiante.apellidos, estudiante.Carrera_id_carrera, estudiante.semestre, carrera.id_carrera, carrera.nombre from estudiante join carrera on estudiante.Carrera_id_carrera = carrera.id_carrera where estudiante.id_estudiante = " . $id_estudiante . "");
            while ($valores1 = mysqli_fetch_assoc($datosestudiante)) {
                $documento = $valores1['documento'];
                $nombres = $valores1['nombres'];
                $apellidos = $valores1['apellidos'];
                $carrera = $valores1['nombre'];
                $semestre = $valores1['semestre'];
            }

            //consultas para las tablas de horario y materias matriculadas del estudiante
            $dhorario = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, clase.id_clase, clase.hora, clase.horafin, dias.id_dia, dias.nombre as nombredia, materia.nombre FROM estudiante JOIN grupo on estudiante.id_estudiante = grupo.Estudiante_id_estudiante join clase on clase.Grupo_id_grupo = grupo.id_grupo join materia on materia.id_materia = clase.Materia_id_materia join dias on dias.id_dia = clase.Dias_id_dia where estudiante.id_estudiante = " . $id_estudiante . " ORDER BY clase.hora, nombredia");
            $Amaterias = $mysql->efectuarConsulta("SELECT estudiante.id_estudiante, grupo.Estudiante_id_estudiante, materia.nombre as nombremateria, materia.id_materia, docente.nombres, docente.apellidos, aula.nombre as nombreaula, dias.nombre as nombredia, clase.hora FROM estudiante JOIN grupo on estudiante.id_estudiante = grupo.Estudiante_id_estudiante join clase on clase.Grupo_id_grupo = grupo.id_grupo join materia on materia.id_materia = clase.Materia_id_materia join docente on docente.id_docente = clase.Docente_id_docente join aula on aula.id_aula = clase.Aula_id_aula join dias on dias.id_dia = clase.Dias_id_dia where estudiante.id_estudiante = " . $id_estudiante . " order by clase.hora");


            //Codigo proporcionado por el usuario Triby en stack overflow
            //https://es.stackoverflow.com/questions/390749/como-poner-campos-en-una-tabla-php-y-mysql
            // Crear arreglo para armar horario
            $horario = [];

            while ($valores1 = mysqli_fetch_assoc($dhorario)) {
                // Verificar que existe hora_inicial en arreglo
                $hora = $valores1['hora']; // . ' - ' . $valores1['horafin'];
                $horafin = $valores1['horafin'];
                $materia = $valores1['nombre'];
                if (!isset($horario[$hora])) {
                    // Crear arreglo con 5 elementos, uno para cada día
                    $horario[$hora] = ['', '', '', '', '', '', ''];
                }
                // Agregar materia a $hora, en espacio correspondiente
                // Los índices de arreglo inician en cero, van de cero = lunes a 4 = viernes
                // Por eso el - 1
                $horario[$hora][$valores1['id_dia'] - 1] = $valores1['nombre'] . " " . $hora . " - " . $horafin;
            }
        }
        $mysql->desconectar();
        //Si el usuario es un estudiante
        if ($_SESSION['tipousuario'] == 1) {
    ?>
    <br>
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
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Semestre</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $documento ?></td>
                                                <td><?php echo $nombres . " " . $apellidos ?></td>
                                                <td><?php echo $carrera ?></td>
                                                <td><?php echo $semestre ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </center>
                        </div>
                        <br><br>

                        <center>
                            <b>
                                <p class="mb-4">Distribuci&oacute;n de las clases</p>
                            </b>
                        </center>
                        <div class="row">
                            <center>
                                <div class="col-md-8 col-md-offset-3">
                                    <table id="" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Lunes</th>
                                                <th>Martes</th>
                                                <th>Miercoles</th>
                                                <th>Jueves</th>
                                                <th>Viernes</th>
                                                <th>Sabado</th>
                                                <th>Domingo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Llenar tabla
                                            foreach ($horario as $hora => $dias) {
                                                echo "
                                                <tr>
                                                    <!-- <td>$hora</td> -->
                                                    <td>{$dias[0]}</td>
                                                    <td>{$dias[1]}</td>
                                                    <td>{$dias[2]}</td>
                                                    <td>{$dias[3]}</td>
                                                    <td>{$dias[4]}</td>
                                                    <td>{$dias[5]}</td>
                                                    <td></td>
                                                </tr>";
                                                //HTML; // Esta línea debe estar en la primera columna, sin espacios ni tabuladores previos
                                            }
                                            // Cerrar tabla
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </center>
                        </div>
                        <br><br>

                        <center>
                            <b>
                                <p class="mb-4">Asignaturas Matriculadas</p>
                            </b>
                        </center>
                        <div class="row">
                            <center>
                                <div class="col-md-8 col-md-offset-3">
                                    <table id="" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Codigo</th>
                                                <th scope="col">Asignatura</th>
                                                <th scope="col">Docente</th>
                                                <th scope="col">Aula</th>
                                                <th scope="col">Dia</th>
                                                <th scope="col">Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                while ($valores3 = mysqli_fetch_assoc($Amaterias)) {
                                                ?>
                                                <td><?php echo $valores3['id_materia'] ?></td>
                                                <td><?php echo $valores3['nombremateria'] ?></td>
                                                <td><?php echo $valores3['nombres'] . " " . $valores3['apellidos'] ?></td>
                                                <td><?php echo $valores3['nombreaula'] ?></td>
                                                <td><?php echo $valores3['nombredia'] ?></td>
                                                <td><?php echo $valores3['hora'] ?></td>
                                            </tr>
                                                <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </center>
                        </div>

                        <div class="text-center">
                            <a class="btn" style="background-color: #2EC82E;color: white" href='Reportes/materias_estudiante.php' role="button"><i class="mdi mdi-file-plus"></i>Generar PDF</a>
                        </div>
                        <br>
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
    <!-- En caso de que no haya una sesion, se redirige al login-->
    <?php
        }
        } else {
            header("refresh:0;url=login.php");
        }
    ?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>

</html>