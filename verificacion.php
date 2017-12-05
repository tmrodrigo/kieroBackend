<?php

$key = "Kiero2017";
$user = "123456";

if ($_POST) {
	if (($_POST['user'] == $user) && ($_POST['pass'] == $key)) {
		$value = true;
		setcookie("validacion", $value, time()+3600);
		header('Location:home-inicio.php');
	}
	else {
		$value = false;
		setcookie("validacion", $value, time()+3600);
		header('Location:index.php?error=1');
	}
}


?>
