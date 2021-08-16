<?php
//condicion donde se rectifica que los campos no esten vacios y que esten definidos
if(isset($_POST['enviar']) && !empty($_POST['documento_docente']) && !empty($_POST['nombre_docente']) && !empty($_POST['apellido_docente']) && !empty($_POST['contrasena']) && !empty($_POST['correo']) && !empty($_POST['tipousuario'])){

        require_once '../../Modelo/MySQL.php';//se llama la pagina mysql.php para hacer la respectiva conexion con la BD
        //declaracion de las variables donde se almacenan los datos de los respectivos campos llenados del formulario metodo post
        $documento=$_POST["documento_docente"];
        $nombre=$_POST["nombre_docente"];
        $apellido=$_POST["apellido_docente"];
        $pass=$_POST["contrasena"];
        $correo=$_POST["correo"];
        $tipo=$_POST["tipousuario"];
        $iddoc = $_GET['id']; 
        
        

        $mysql = new MySQL;//nuevo mysql
        $mysql->conectar();//funcion almacenada en mysql.php
        //consulta de la insercion de datos en la base de datos, donde hace las respectivas consultas

        $sql=$mysql->efectuarConsulta("UPDATE asistencia.docente SET documento ='".$documento."', nombres = '".$nombre."', apellidos ='".$apellido."',clave ='".$pass."',correo ='".$correo."', tipo_usuario_id_tipo_usuario ='".$tipo."'  WHERE id_docente = ".$iddoc."");
        //condicion donde si la consulta se hace correcto
        if($sql){
            //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
            echo"<script type=\"text/javascript\">alert('Se actualizo correctamente'); window.location='../../index.php';</script>";

        }else{
            //mensaje de salida en caso de que la consulta falle
            echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../../update_docente.php';</script>";
        }
        
         
}
?>