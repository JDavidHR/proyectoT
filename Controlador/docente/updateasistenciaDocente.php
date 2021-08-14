<?php
//condicion donde se rectifica que los campos no esten vacios y que esten definidos
if(isset($_POST['submit']) && !empty($_POST['idclaseimprimir']) && !empty($_POST['fechaclase'])){


    require_once '../../Modelo/MySQL.php';//se llama la pagina mysql.php para hacer la respectiva conexion con la BD
    //declaracion de las variables donde se almacenan los datos de los respectivos campos llenados del formulario metodo post
    $comentarios=$_POST["comentarios"];
    $id_clase = $_POST['idclaseimprimir'];
    $fechaclase = $_POST['fechaclase']; 

    $mysql = new MySQL;//nuevo mysql
    $mysql->conectar();//funcion almacenada en mysql.php
    //consulta de la insercion de datos en la base de datos, donde hace las respectivas consultas

    $MostrarDatos = $mysql->efectuarConsulta("SELECT asistencia.a_docente.ida_docente, asistencia.a_docente.clase_id_clase, asistencia.clase.Materia_id_materia, asistencia.materia.nombre as nombremateria, asistencia.grupo.id_grupo, asistencia.grupo.nombre as nombregrupo, asistencia.a_docente.fecha, asistencia.clase.codigo, asistencia.links.id_links, asistencia.links.links, asistencia.a_docente.estado FROM a_docente JOIN asistencia.clase ON asistencia.a_docente.clase_id_clase = asistencia.clase.id_clase JOIN asistencia.materia ON asistencia.clase.Materia_id_materia = asistencia.materia.id_materia JOIN asistencia.grupo ON asistencia.clase.Grupo_id_grupo = asistencia.grupo.id_grupo JOIN asistencia.links ON asistencia.a_docente.clase_id_clase = asistencia.links.clase_id_clase WHERE asistencia.a_docente.estado = 'Activa' AND asistencia.a_docente.estado2 = 1 AND asistencia.a_docente.clase_id_clase = ".$id_clase." GROUP BY asistencia.materia.nombre");

      //se inicia el recorrido para mostrar los datos de la BD

      while ($valores1 = mysqli_fetch_assoc($MostrarDatos)) {
        //declaracion de variables
        $id_links = $valores1['id_links'];
        $ida_docente = $valores1['ida_docente'];
      }

      


    $sql = $mysql->efectuarConsulta("UPDATE asistencia.links SET asistencia.links.links = '".$comentarios."', asistencia.links.fecha ='".$fechaclase."' WHERE asistencia.links.clase_id_clase = ".$id_clase." AND asistencia.links.id_links = ".$id_links."");


    //condicion donde si la consulta se hace correcto
    if($sql){
        $sql2 = $mysql->efectuarConsulta("UPDATE asistencia.a_docente SET asistencia.a_docente.fecha ='".$fechaclase."' WHERE asistencia.a_docente.ida_docente = ".$ida_docente."");
        //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
        if($sql2){
        echo"<script type=\"text/javascript\">alert('Se actualizo correctamente'); window.location='../../clases_vistas.php';</script>";
        }else{
            echo"<script type=\"text/javascript\">alert('Se produjo un error 2'); window.location='../../index.php';</script>";
        }

    }else{
        //mensaje de salida en caso de que la consulta falle
        echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../../index.php';</script>";
    }
}
?>