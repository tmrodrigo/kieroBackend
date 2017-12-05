<?php

function esUnaImagen($ext) {
	$ext = strtolower($ext);
	if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
		return TRUE;
	}
	return FALSE;
}

function tienePesoValido($size) {

	$pesoMaximo = 1000000;
	// 5 MB

	if ($size > $pesoMaximo) {
		return FALSE;
	}
	return TRUE;
}


function validarProduct($miProduct)
{
	$errores = [];
	$ext = pathinfo($_FILES['imgName']['name'], PATHINFO_EXTENSION);

	if (trim($miProduct["name"]) == "")
	{
		$errores[] = "Falta el nombre";
	}
	if (trim($miProduct["description"]) == "")
	{
		$errores[] = "Es necesaria una descripción";
	}
	if (strlen($miProduct["description"]) > 255)
	{
		$errores[] = "La descripción es muy larga";
	}
	if ($miProduct["category"] == "")
	{
		$errores[] = "Debe seleccionar una categoría";
	}
	if (empty($_FILES["imgName"])) {
		$errores[] = "Falta cargar una imagen del producto";
	}
	if (!esUnaImagen($ext)) {
		$errores[] = "El formato de imagen deber ser jpg, png o gif";
	}
	if (!tienePesoValido($_FILES["imgName"]["size"])) {
		$errores[] = "La imagen es muy pesada debe ser menor a 1 mb";
	}
	if (trim($miProduct["brand"] == ""))
	{
		$errores[] = "Debe seleccionar una marca";
	}
	return $errores;
}

function crearProduct($miProduct) 	{
		$Product = [
			"name" => strtolower($miProduct["name"]),
			"description" => strtolower($miProduct["description"]),
			"category" => $miProduct["category"],
			"imgName" => $_FILES['imgName']['name'],
			"brand" => strtolower($miProduct["brand"]),
			"art" => strtolower($miProduct["art"]),
			"stock" => strtolower($miProduct["stock"])
		];
		return $Product;
}

function validarUsuario($miUsuario) {
		$errores = [];

		if (trim($miUsuario["name"]) == "")
		{
			$errores[] = "Falta el nombre";
		}
		if (trim($miUsuario["pass"]) == "")
		{
			$errores[] = "Falta la pass";
		}
		if (trim($miUsuario["cPass"]) == "")
		{
			$errores[] = "Falta el cpass";
		}
		if ($miUsuario["pass"] != $miUsuario["cPass"])
		{
			$errores[] = "Pass y Cpass son distintas";
		}
		if ($miUsuario["email"] == "")
		{
			$errores[] = "Falta el mail";
		}
		if (!filter_var($miUsuario["email"], FILTER_VALIDATE_EMAIL))
		{
			$errores[] = "El mail tiene forma fea";
		}
		return $errores;
}

function crearUsuario($miUsuario) 	{
		$usuario = [
			"name" => $miUsuario["name"],
			"password" => sha1($miUsuario["pass"]),
			"email" => $miUsuario["email"],

		];
		return $usuario;
}

function enviarAFelicidad()
{
		header("location:index.php");exit;
}

?>
