<?php
/* 
 * Cierra la sesión como usuario validado
 */

include('php_lib/usuario.class.php'); //incluimos las funciones
usuario::logout(); //vacia la session del usuario actual
header('Location: index.php'); //saltamos a login.php

?>
