<?php require_once("../php/database.php");
if ($_COOKIE['validacion'] == false || !isset($_COOKIE['validacion'])) {
  header('Location:index.php?error=2');
}
$SeccionTitle = "";
$noHay = "";
if ($_GET) {
  if (!empty($_GET["section"]))
  {
    $query = $db->query('SELECT * FROM ' . $_GET["section"]);

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

  }

  if($_GET["section"] == "locals" && (empty($_GET["limit"]) || isset($_GET["limit"]))){
    $query = $db->query('SELECT * FROM locals Limit '.$_GET["limit"].', 50');

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    $q = $db->query('SELECT count(*) FROM locals');
    $cant = $q->fetchAll(PDO::FETCH_ASSOC);

    $c = $cant[0]["count(*)"];
    if (empty($results)) {
      $noHay = "No se encontraron productos";
    }
  }

  if(isset($_GET["list"]) && $_GET["section"] == "products"){
    $query = $db->query('SELECT * FROM products WHERE product_name LIKE "'. $_GET["list"] .'%"');

    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    if (empty($results)) {
      $noHay = "No se encontraron productos";
    }
  }
  if(isset($_GET["category"]) && $_GET["section"] == "products"){
    $query = $db->query('SELECT * FROM products WHERE product_category = "'. $_GET["category"] .'"');

    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    if (empty($results)) {
      $noHay = "No se encontraron productos";
    }
  }

     switch ($_GET["section"]) {
      case 'districts':
        $tSec = "Localidades";
        break;
      case 'states':
        $tSec = "Provincias";
        break;
      case 'products':
        $tSec = "Productos";
        break;
      case 'users':
        $tSec = "Usuarios";
        break;
      case 'locals':
        $tSec = "Locales";
        break;
      default:
        $tSec = $item["TABLE_NAME"];
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("php/head.php") ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require_once('php/side_bar_menu.php'); ?>
        <div class="right_col" role="main">
          <div class="">


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?= strtoupper($tSec)?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php if ($_GET["section"] == "locals") { ?>
                      <h4>Páginas</h4>
                      <ul class="pagination pagination-split">
                        <?php $v = 1 ?>
                        <?php foreach (range(0, $c, 50) as $char) { ?>
                          <li><a href="seccion.php?section=locals&&limit=<?=$char?>"><?=$v++?></a></li>
                        <?php } ?>
                      </ul>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nombre Local</th>
                            <th>Dirección</th>
                            <th>Localidad / Provincia</th>
                            <th>Teléfono</th>
                            <th>Mail</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($results as $local) { ?>
                            <tr>
                              <th scope="row"><?=$local["id"]?></th>
                              <td><?=$local["local_name"]?></td>
                              <td><?=$local["local_address"]?></td>
                              <td><?=$local["local_district"] . "-" . $local["local_state"]?></td>
                              <td><?=$local["local_phone"]?></td>
                              <td><?=$local["local_mail"]?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    <?php } ?>

                    <?php if ($_GET["section"] == "products") { ?>
                      <?php $ultCarga=[]; $mensaje = ""; $mCarga = ""; if (isset($_GET["carga"]) && $_GET["section"] == "products") { ?>
                        <?php if ($_GET["carga"] == "s"){
                          $mCarga = "El producto se cargó en la base de datos";
                          $query = $db->query('SELECT * FROM products ORDER BY id DESC LIMIT 1');
                          $ultCarga = $query->fetchAll(PDO::FETCH_ASSOC);
                          // echo "<pre>"; var_dump($ultCarga); die();
                        }
                        if ($_GET["carga"] == "n"){
                          $mCarga = "Hubo un problema en la base de datos";
                        }?>
                      <?php } ?>
                      <div id="products">
                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="">
                              <div class="">
                                <h3>Carga de producto</h3>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                <br />
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="carga-producto.php">

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del producto <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" name="name" value="" placeholder="nombre de producto" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Código del producto: <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" name="art" value="" placeholder="código del producto" id="first-art" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" name="description" value="" placeholder="descripción" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Cargá una imagen</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input id="middle-name" type="file" name="imgName"  class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoría</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select class="" name="category">
                                        <option value="pesca">pesca</option>
                                        <option value="outdoor">outdoor</option>
                                        <option value="nautica">nautica</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Marca <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input id="birthday" name="brand" value="" placeholder="nombre de la marca" class="form-control col-md-7 col-xs-12" required="required" type="text">
                                    </div>
                                  </div>
                                  <div class="form-group stock">
                                    <label>
                                       <p>En Stock:</p>
                                        <input type="checkbox" class="js-switch" checked="1" data-switchery="true" style="display: none;" name="stock" value="1">
                                    </label>
                                  </div>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      <button type="submit" class="btn btn-success">Cargar</button>
                                    </div>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="">
                              <div class="">
                                <h3>Último producto</h3>
                                <div class="x_content">
                                  <?php if (isset($_GET['eliminar']) && $_GET['eliminar'] == "s" ) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                      </button>
                                      <strong>producto eliminado correctamente</strong>
                                    </div>
                                  <?php } ?>
                                  <?php if (isset($_GET['eliminar']) && $_GET['eliminar'] == "n" ) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                      </button>
                                      <strong>error en el servidor, intente más tarde</strong>
                                    </div>
                                  <?php } ?>
                                </div>
                                <h5><?=$mCarga?></h5>
                              </div>
                              <div class="x_content">
                                <?php foreach ($ultCarga as $product) { ?>
                                  <div class="">
                                    <div class="">
                                      <div class="col-sm-12">
                                        <div class="left col-xs-5 text-center">
                                          <img src="../images/productos/<?=$product['product_category']?>/<?=$product['product_img']?>" alt="" class="img-responsive">
                                        </div>
                                        <div class="right col-xs-7">
                                          <h4 class="brief"><i><?=$product['product_category']?></i></h4>
                                          <?php if ($product['stock'] == 1){ ?>
                                            <?php $stock = "En stock"; ?>
                                          <?php } else {$stock = "";}?>
                                          <p class="stockItem"><?=$stock?></p>
                                          <h2><?=$product['product_name']?></h2>
                                          <p><strong>Descripción: </strong><?=$product['product_description']?></p>
                                          <ul class="list-unstyled">
                                            <li>Categoría: <?=$product['product_category']?></li>
                                            <li>Marca: <?=$product['product_brand']?></li>
                                            <li>Código: <?=$product['product_art']?></li>
                                          </ul>
                                          <a href="seccion.php?section=products&&item=<?=$product['id']?>#editar" class="btn btn-primary btn-xs">
                                            <i class="fa fa-pencil" onclick="ir()"> </i> Editar
                                          </a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php $mensaje = "";if (isset($_GET["act"]) && $_GET["section"] == "products") { ?>
                          <?php if ($_GET["act"] == "s"){
                            $mensaje = "Producto actualizado correctamente";
                          }
                          if ($_GET["act"] == "n"){
                            $mensaje = "Hubo un problema en la base de datos";
                          }?>
                        <?php } ?>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                          <h4>Busqueda alfabética</h4>
                          <ul class="pagination pagination-split">
                            <?php foreach (range('A', 'Z') as $char) { ?>
                              <li><a href="seccion.php?section=products&&list=<?=$char?>"><?=$char?></a></li>
                            <?php } ?>
                            <li><a href="seccion.php?section=products">Todos</a></li>
                          </ul>
                          <div class="x_content">
                            <h4>Busqueda por categoría</h4>
                            <div class="pagination">
                              <ul class="pagination pagination-split">
                                  <li><a href="seccion.php?section=products&&category=pesca">pesca</a></li>
                                  <li><a href="seccion.php?section=products&&category=nautica">nautica</a></li>
                                  <li><a href="seccion.php?section=products&&category=outdoor">outdoor</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <h2><?=$noHay;?></h2>
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                          <h2 id="actualizar"><?=$mensaje?></h2>
                        </div>
                        <?php if (isset($_GET["item"]) && $_GET["section"] == "products") { ?>

                          <?php foreach ($results as $item) { ?>
                          <?php  if ($_GET["item"] == $item["id"]){?>
                            <div class="editarItem" id="editar">
                              <div class="row">
                                <div class="">
                                  <h2>Editar item</h2>
                                </div>
                                <div class="col-sm-6">
                                  <div class="col-sm-6">
                                    <img src="../images/productos/<?=$item['product_category']?>/<?=$item['product_img']?>" alt="">
                                  </div>
                                  <div class="col-sm-offset-1 col-sm-5">
                                    <h2><?=$item["product_category"]?></h2>
                                    <h1><?=$item["product_name"]?></h1>
                                    <h3><?=$item["product_brand"]?></h3>
                                    <h4><?=$item["product_art"]?></h4>
                                    <p>Descripción: <?=$item["product_description"]?></p>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <br />
                                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="actualizar-producto.php?item=<?=$item["id"]?>">

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre del producto <span class="required">*</span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="name" value="<?=$item["product_name"]?>" placeholder="nombre de producto" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Código del producto: <span class="required">*</span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="art" value="<?=$item["product_art"]?>" placeholder="código del producto" id="first-art" required="required" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripción <span class="required">*</span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="description" value="<?=$item["product_description"]?>" placeholder="descripción" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Cargá una imagen</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="middle-name" type="file" name="imgName"  class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoría</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="" name="category">
                                          <option value="pesca">pesca</option>
                                          <option value="outdoor">outdoor</option>
                                          <option value="nautica">nautica</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Marca <span class="required">*</span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="birthday" name="brand" value="<?=$item["product_brand"]?>" placeholder="nombre de la marca" class="form-control col-md-7 col-xs-12" required="required" type="text">
                                      </div>
                                    </div>
                                    <div class="form-group stock">
                                      <label>
                                         <p>En Stock:</p>
                                          <input type="checkbox" class="js-switch" checked="1" data-switchery="true" style="display: none;" name="stock" value="1">
                                      </label>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                      </div>
                                    </div>

                                  </form>
                                  <form class="" action="delete-product.php" method="post">
                                    <input type="text" name="id" value="<?=$item["id"]?>" style="display:none">
                                    <button type="submit" name="button" class="btn btn-danger">Eliminar producto</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                           <?php } ?>
                         <?php }?>
                        <?php }?>
                        <?php foreach ($results as $product) { ?>
                          <div class="col-md-3 col-sm-3 col-xs-12 profile_details">
                            <div class="well profile_view">
                              <div class="col-sm-12">
                                <h4 class="brief"><i><?=$product['product_category']?></i></h4>
                                <div class="left col-xs-7">
                                  <?php if ($product['stock'] == 1){ ?>
                                    <?php $stock = "En stock"; ?>
                                  <?php } else {$stock = "";}?>
                                  <p class="stockItem"><?=$stock?></p>
                                  <h2><?=$product['product_name']?></h2>
                                  <p class="parrafo"><strong>Descripción: </strong><?=$product['product_description']?></p>
                                  <ul class="list-unstyled">
                                    <li><strong>Categoría: </strong><?=$product['product_category']?></li>
                                    <li><strong>Marca: </strong><?=$product['product_brand']?></li>
                                    <li><strong>Código: </strong><?=$product['product_art']?></li>
                                  </ul>
                                </div>
                                <div class="right col-xs-5 text-center">
                                  <img src="../images/productos/<?=$product['product_category']?>/<?=$product['product_img']?>" alt="" class="img-responsive">
                                </div>
                              </div>
                              <div class="col-xs-12 bottom text-center">
                                <div class="col-xs-12 col-sm-6 emphasis">
                                  <a href="seccion.php?section=products&&item=<?=$product['id']?>" class="btn btn-primary btn-xs">
                                    <i class="fa fa-pencil" onclick="ir()"> </i> Editar
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div>
            <p>© <?=date('Y')?> Kiero SRL - Desarrollado por <a href="http://www.loveinbrands.com">love in brands</a></p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

<?php require_once("php/scripts.php"); ?>

  </body>
</html>
