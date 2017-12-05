<?php
$dsn = 'mysql:host=localhost;dbname=kiero;charset=utf8mb4;port:3306';
$db_user = 'root';
$db_pass = '';

// info servidor prod
// $dsn = 'mysql:host=192.168.0.170;dbname=kiero;charset=utf8;port:3306';
// $db_user = 'kiero';
// $db_pass = 'Libertador650';

try {
 $db = new PDO($dsn, $db_user, $db_pass);
}
catch( PDOException $Exception ) {
 echo $Exception->getMessage();
}

?>
