<?php

if ($_FILES)
{

	$path = $_FILES['catalogo']['tmp_name'];

	$nombre = $_FILES['catalogo']['name'];
	$archivo = '../secciones/'. $_POST["category"] .'/' . $nombre;

	$upload = move_uploaded_file($_FILES['catalogo']['tmp_name'], $archivo);

	if ($upload == 1) {
		header("Location:home-inicio.php?catalogo=s");
	}
	else {
		header("Location:home-inicio.php?catalogo=n");
	}
}
?>
