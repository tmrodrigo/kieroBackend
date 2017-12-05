<?php require_once("../php/database.php");

$query = $db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='kiero'");

$items = $query->fetchAll(PDO::FETCH_ASSOC);

$nombre = ""; //TO - DO -- traer nombre de DB;

?>

<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.html" class="site_title"><span>Kiero SRL</span></a>
    </div>
    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
      </div>
      <div class="profile_info">
        <span>Hola,</span>
        <h2><?= $nombre;?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3><?=$tSec?></h3>
        <ul class="nav side-menu">
          <li><a href="home-inicio.php">Home</a></li>
          <?php foreach ($items as $item) { ?>
            <?php switch ($item["TABLE_NAME"]) {
              case 'districts':
                $nItem = " ";
                $link = "";
                break;
              case 'states':
                $nItem = " ";
                $link = "";
                break;
              case 'products':
                $nItem = "Productos";
                $link = "products";
                break;
              case 'users':
                $nItem = " ";
                $link = "";
                break;
              case 'locals':
                $nItem = "Locales";
                $link = "locals&&limit=0";
                break;
              default:
                $nItem = $item["TABLE_NAME"];
                $link = "";
                break;
            } ?>
          <li><a href="seccion.php?section=<?= $link?>"><?= $nItem;?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
