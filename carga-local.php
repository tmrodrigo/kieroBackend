<?php

require_once('../php/database.php');
require_once('validar-local.php');

$result = $db->query('select state_name from states where id = '. $_POST["local_state"]);

$provincia = $result->fetchAll();

echo "<pre>";
// var_dump();
$owner = $_POST['local_owner'];
$name = $_POST['local_name'];
$mail =  $_POST['local_mail'];
$phone =  $_POST['local_phone'];
$address =  $_POST['local_address'];
$state =  $provincia[0]['state_name'];
$district =  $_POST['local_district'];
$cat =  $_POST['local_category'];
$c = "";
foreach ($cat as $value) {
	if (count($cat) > 1) {
		$c = $c . $value . ', ';
		$category = substr($c, 0, -2);
	}
	else {
		$category = $value;
	}
}

$errores = "";

$errores = validar($_POST);

if ($errores === "Datos requeridos")
  {
    header("Location:home-inicio.php?carga=n");
  }
  else {
    $nuevoLocal = "INSERT INTO locals (local_owner, local_name, local_address, local_district, local_state, local_phone, local_mail, local_category) VALUES ('". $owner . "', '". $name . "', '". $address . "', '". $district . "', '". $state . "', '". $phone . "', '". $mail . "', '". $category . "')";

    try
    {
      $query = $db->prepare($nuevoLocal);
      $query->execute();
    }

    catch( PDOException $Exception )
    {
     echo $Exception->getMessage();
   } header("Location:home-inicio.php?carga=s");
  }
?>
