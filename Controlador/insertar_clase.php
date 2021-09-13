<?php
//condicion donde se rectifica que los campos no esten vacios y que esten definidos

        require_once '../Modelo/MySQL.php';//se llama la pagina mysql.php para hacer la respectiva conexion con la BD
        //declaracion de las variables donde se almacenan los datos de los respectivos campos llenados del formulario metodo post
        $dia = $_POST["dia"];
        $hora = $_POST["hora"];
        $horafin = $_POST["horafin"];
        $codigo = $_POST["codigo"];
        $docente = $_POST["nombre_docente"];
        $aula = $_POST["aula"];
        $materia = $_POST["materia"];
        $grupo = $_POST["grupo"];
        

        $mysql = new MySQL;//nuevo mysql
        $mysql->conectar();//funcion almacenada en mysql.php
        //consulta de la insercion de datos en la base de datos, donde hace las respectivas consultas
        $sql = $mysql->efectuarConsulta("insert into asistencia.clase(Dias_id_dia,hora,horafin,codigo,Docente_id_docente,Aula_id_aula,Materia_id_materia,Grupo_id_grupo,estado) VALUES ('".$dia."','".$hora."', '".$horafin."','".$codigo."','".$docente."','".$aula."','".$materia."','".$grupo."',1)");
        //condicion donde si la consulta se hace correcto
        echo " consulta: ".$sql;
        if($sql){
            //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
            echo"<script type=\"text/javascript\">alert('Se registro correctamente'); window.location='../index.php';</script>";

        }else{
            //mensaje de salida en caso de que la consulta falle
           echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../registro_horario.php';</script>";
        }
        
        

?>