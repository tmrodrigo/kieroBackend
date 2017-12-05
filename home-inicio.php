<?php require_once("../php/database.php");?>
<?php
// if ($_COOKIE['validacion'] == false || !isset($_COOKIE['validacion'])) {
//   header('Location:index.php?error=2');
//}
?>
<?php
$nombre = "";
$mensaje = "";
if ($_GET) {
  if (isset($_GET['carga'])) {
    if (!empty($_GET['carga'] && $_GET['carga'] == "s")){
      $mensaje = "Exito el local fue agregado a la base de datos";
      $clase = "alert-success";
    }

    if (!empty($_GET['carga'] && $_GET['carga'] == "n")){
      $mensaje = "Faltan datos para procesar la información";
      $clase = "alert-danger";
    }
  }

  if (isset($_GET['catalogo'])) {
    if (!empty($_GET['catalogo'] && $_GET['catalogo'] == "s")){
      $mensaje = "Catálogo actualizado";
      $clase = "alert-success";
    }

    if (!empty($_GET['catalogo'] && $_GET['catalogo'] == "n")){
      $mensaje = "Hubo un error en el servidor, intenta más tarde";
      $clase = "alert-danger";
    }
  }
}
else {
  $nombre = "";
}
$q = $db->query('SELECT * FROM states');

$states = $q->fetchAll(PDO::FETCH_ASSOC);

$tSec = "Home";
?>
<!DOCTYPE html>
<html lang="en">
  <?php require_once("php/head.php") ?>
  <body>
    <div class="container body">
      <div class="main_container">
        <?php  require_once('php/side_bar_menu.php'); ?>
      </div>
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Nuevo local <small></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php if (!empty($_GET['carga'])) { ?>
                      <div class="alert <?=$clase?> alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong><?=$mensaje?></strong>
                      </div>
                    <?php } ?>
                    <br />
                    <form class="form-horizontal form-label-left" action="carga-local.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre Dueño del Local</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="local_owner" value="" type="text" class="form-control" placeholder="Ej. Pepe">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del Local * </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="local_name" value="" type="text" class="form-control" placeholder="Ej. Pepe pesca S.A">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email *</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="local_mail" value="" type="email" class="form-control" placeholder="Ej. info@pepepesca.com.ar">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono de contacto *</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="local_phone" value="" type="text" class="form-control" placeholder="Ej. 011-4258-7895">
                          <span>Tener en cuenta el código de área de la provincia, y si es o no celular</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección del Local *</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="local_address" name="" type="text" class="form-control" placeholder="Ej. Av. Rivadavia 2331">
                          <span>Formato de dirección: "Nombre de calle/avenida altura"<br><b>Omitir, puntos de referencia, piso, número de local</b></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Provincia</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="local_state" value="" class="form-control" id="provincia">
                            <?php foreach ($states as $state) { ?>
                              <option value="<?=$state['id']?>"><?=$state['state_name']?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Localidad</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="local_district" value="" class="select2_single form-control" id="localidad" disabled>
                            <option value="">Seleccione una provincia</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Categorías
                          <br>
                          <small class="text-navy">Elegir al menos una</small>
                        </label>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="flat" name="local_category[]" value="Pesca"> Pesca
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="flat" name="local_category[]" value="Outdoor"> Outdoor
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="flat" name="local_category[]" value="Náutica"> Náutica
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Cargar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Actualizar Catálogos <small></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <?php if (!empty($_GET['catalogo'])) { ?>
                    <div class="alert <?=$clase?> alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <strong><?=$mensaje?></strong>
                    </div>
                  <?php } ?>
                  <div class="x_content">
                    <h4>A tener en cuenta: el nombre del pdf a cargar deberá ser: catalogo-"nombre de categoria" | sin espacios, acentos y en minúsculas.</h4>
                    <br />
                    <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" method="post" action="carga-catalogo.php">
                      <div class="form-group">
                        <label for="">Seleccionar categoría</label>
                        <select class="" name="category">
                          <option value="pesca">Pesca</option>
                          <option value="outdoor">Outdoor</option>
                          <option value="nautica">Náutica</option>
                        </select>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <label for="">Catálogo</label>
                        <input type="file" name="catalogo" value="">
                      </div>

                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Cargar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer>
          <div>
            <p>© <?=date('Y')?> Kiero SRL - Desarrollado por <a href="http://www.loveinbrands.com">love in brands</a></p>
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
      <?php require_once("php/scripts.php") ?>

      <script type="text/javascript">
      $('#provincia').on('change', function(){
        var q = $('#provincia').val()
        var url = 'localidad.php?provincia='+q
        $('#localidad').removeAttr('disabled')
        getInfo(url);
      })
      function getInfo(u){
        $.get({
           url: u,
           success : function(response) {
             $('#localidad').empty();
             $('#localidad').append(response);
           }
        });
      }
      </script>
    </body>
</html>
