<!DOCTYPE html>
<html lang="en">
  <?php require_once("php/head.php") ?>
  <?php
  $error = "";
  if ($_GET) {
    if ($_GET["error"] == 1) {
      $error = "User o clave incorrectos";
    }
    if ($_GET["error"] == 2) {
      $error = "Inicie sesión";
    }
  }
  ?>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
              <p><?=$error?></p>
            </div>
          <?php } ?>
          <section class="login_content">
            <form action="verificacion.php" method="post">
              <h1>Bienvenido</h1>
              <div>
                <input name="user" value="" type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input name="pass" value="" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit">Acceder</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!-- <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>Kiero SRL</h1>
                  <p>© <?=date('Y')?> Kiero SRL - Desarrollado por <a href="http://www.loveinbrands.com">love in brands</a></p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
