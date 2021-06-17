<?php
    //iniciamos la session 
    session_start();
    // Destruir todas las variables de sesión.
    $_SESSION = array();    
    
    // Destruir todas las variables de sesión.
    session_destroy();
    
    //Dirigirse a la pagina principal
    header("Location: ../login.php"); 
    ?>