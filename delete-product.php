<?php
require_once("../php/database.php");

if ($_POST) {
  $eliminar = "DELETE FROM products WHERE id = ". $_POST['id'];

  try
  {
    $query = $db->prepare($eliminar);
    $query->execute();
  }

  catch( PDOException $Exception )
  {
   echo $Exception->getMessage();
 } header("Location:seccion.php?section=products&&eliminar=s");

}
else {
  header("Location:seccion.php?section=products&&eliminar=n");
}


?>
