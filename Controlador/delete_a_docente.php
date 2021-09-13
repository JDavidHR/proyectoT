<?php
        require_once '../Modelo/MySQL.php';//se llama la pagina mysql.php para hacer la respectiva conexion con la BD
        //declaracion de las variables donde se almacenan los datos de los respectivos campos llenados del formulario metodo post
        $ida_docente = $_GET['ida_docente'];

        $mysql = new MySQL;//nuevo mysql
        $mysql->conectar();//funcion almacenada en mysql.php
        //consulta de la insercion de datos en la base de datos, donde hace las respectivas consultas

        $sql = $mysql->efectuarConsulta("UPDATE asistencia.a_docente SET estado2 = 0 WHERE ida_docente = ".$ida_docente."");
        //condicion donde si la consulta se hace correcto
        if($sql){
            echo"<script type=\"text/javascript\">alert('Eliminado Correctamente'); window.location='../clases_vistas.php';</script>";
        }else{
            //mensaje de salida en caso de que la consulta falle
            echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../index.php';</script>";
        }
?>