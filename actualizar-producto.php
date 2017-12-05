<?php require_once("../php/database.php"); require_once("php/funciones.php");?>

<?php

if ($_POST && $_GET)
{
  $errores = validarProduct($_POST);

  var_dump($errores);

  if (empty($errores))
  {
    $product = crearProduct($_POST);
    $nuevoProducto = "UPDATE products SET product_name = '".$product["name"]."', product_description = '".$product["description"]."', product_img = '".$product["imgName"]."', product_category = '".$product["category"]."', product_brand = '".$product["brand"]."', product_art = '".$product["art"]."', stock = '".$product["stock"]."' WHERE id = '". $_GET["item"] ."'";
    $path = $_FILES['imgName']['tmp_name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $archivo = '../images/productos/'. $_POST["category"] .'/' . $_FILES['imgName']['name'];
    $upload = move_uploaded_file($_FILES['imgName']['tmp_name'], $archivo);

    try
    {
      $query = $db->prepare($nuevoProducto);
      $query->execute();
    }

    catch( PDOException $Exception )
    {
     echo $Exception->getMessage();
   } header("Location:seccion.php?section=products&&act=s");
  }
  else {
    header("Location:seccion.php?section=products&&act=n");
  }
}
?>
