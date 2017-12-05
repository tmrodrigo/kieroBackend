<?php
// unset($_COOKIE['validacion']);
setcookie("validacion", TRUE, time()-1);
header('Location:index.php');
?>
