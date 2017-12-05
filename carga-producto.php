<?php require_once("../php/database.php"); require_once("php/funciones.php");?>

<?php
if ($_POST)
{

  $errores = validarProduct($_POST);

  if (empty($errores))
  {

    $product = crearProduct($_POST);

    $nuevoProducto = "INSERT INTO products (product_name, product_description, product_img, product_category, product_brand, product_art, stock) VALUES ('".$product["name"]."', '".$product["description"]."', '".$product["imgName"]."', '".$product["category"]."', '".$product["brand"]."', '".$product["art"]."', '".$product["stock"]."')";
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
   } header("Location:seccion.php?section=products&&carga=s");
  }
  else {
    header("Location:seccion.php?section=products&&carga=n");
  }
}
?>
