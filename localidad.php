<?php
require_once('../php/database.php');

$result = $db->query('select * from districts where id_state = '. $_GET["provincia"] .' order by district_name asc');

$consulta = $result->fetchAll();

if(!empty($consulta)) {

  if (isset($_GET['provincia'])) {
    foreach ($consulta as $local) {
      echo '<option value="'. $local['district_name'] .'">'. $local['district_name'] .'</option>';
    }
  }
}
?>
