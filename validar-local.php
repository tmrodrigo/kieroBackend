<?php

function validar($local){
	if (empty($local['local_owner']) || empty($local['local_name']) || empty($local['local_address']) || empty($local['local_state']) ||  empty($local['local_phone']) || empty($local['local_mail']))
	{
		$error = "Datos requeridos";
		return $error;
	}
}




?>
