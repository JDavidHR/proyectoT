<?php
if(isset($_POST['submit']) && isset($_POST['codigo_clase']) && isset($_POST['idmateria']) && isset($_POST['fechaclase'])){
    //Archivo requerido para hacer las peticiones a la base de datos
    require_once '../Modelo/MySQL.php';

    session_start();
    $id_estudiante = $_SESSION['idEstudiante'];
    $codigo = $_POST['codigo_clase'];//Encriptada
    $idmateria = $_POST['idmateria'];
    $fechaclase = $_POST['fechaclase'];
    

    $mysql = new MySQL(); //se declara un nuevo array
    $mysql->conectar();
    //ejecucion de la consulta a la base de datos

    $consulta = $mysql->efectuarConsulta("SELECT asistencia.a_docente.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre, asistencia.a_docente.fecha, asistencia.a_docente.estado, asistencia.clase.codigo, asistencia.clase.Grupo_id_grupo, asistencia.grupo.Estudiante_id_estudiante, asistencia.estudiante.nombres from asistencia.a_docente JOIN asistencia.clase ON asistencia.a_docente.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo JOIN asistencia.estudiante ON asistencia.grupo.Estudiante_id_estudiante = asistencia.estudiante.id_estudiante WHERE asistencia.clase.Materia_id_materia = ".$idmateria." AND asistencia.clase.codigo = '".$codigo."' AND asistencia.a_docente.fecha = '".$fechaclase."' AND asistencia.estudiante.id_estudiante = ".$id_estudiante." AND asistencia.a_docente.estado = 'Activa'");

    while ($valores1 = mysqli_fetch_assoc($consulta)) {
            //declaracion de variables
            $idclase = $valores1['clase_id_clase'];
        }
    
    //echo "El id de la clase es: ".$idclase;

    $sql = $mysql->efectuarConsulta("UPDATE asistencia.a_estudiante SET asistencia.a_estudiante.asistio = 'Si' WHERE asistencia.a_estudiante.clase_id_clase = ".$idclase." AND asistencia.a_estudiante.fecha = '".$fechaclase."' AND asistencia.a_estudiante.estudiante_id_estudiante = ".$id_estudiante."");

    //Se valida si la consulta arrojo algun valor
    if($consulta){
        if ($sql) {
            //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
            echo"<script type=\"text/javascript\">alert('Asistencia registrada'); window.location='../index.php';</script>";
        }else{
            echo"<script type=\"text/javascript\">alert('Se produjo un error - La clase no esta activa o los datos son erroneos'); window.location='../paginas/estudiante/validar_asistencia.php';</script>";
        }
    }else{
        //mensaje de salida en caso de que la consulta falle
        echo"<script type=\"text/javascript\">alert('La clase esta inactiva, por favor revise los datos'); window.location='../paginas/estudiante/validar_asistencia.php';</script>";
    }
    
    $mysql->desconectar();   
} else {
    echo "0";
}
?>