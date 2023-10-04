<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Prata&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo BASE_URL; ?>Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/modulos/login.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/modulos/btn.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/modulos/boton.css">

  <title>Iniciar Sesión</title>
</head>

<body>

  <div class="container-form sign-in">
    <form class="formulario" id="frmLogin">
      <!-- <h2 class="create-account">Recuperar contraseña</h2> -->
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-3">Cambiar contraseña</h1>
        <p class="mb-5">Estamos a un paso, a continuación
          ¡Digita la nueva contraseña!</p>
      </div>

      <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">
      <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">
      <input type="password" class="form-control form-control-user" id="inputPass" name="inputPass" aria-describedby="emailHelp" placeholder="Nueva contraseña">
      <button type="submit" id="btnLogin" class="login-btn" onclick="frmRecuperarPassword(event);">Aceptar</button>

      <div id="content">
      </div>

      <!-- <br><br> -->
      <hr style="border-style: inset; border-width: 1px;">
      <!-- <br> -->
      <div class=" text-center">
        <a class="small" style="color: white; text-decoration: none;" href="<?php echo BASE_URL; ?>">Volver al inicio de sesión</a>
      </div>
    </form>
  </div>

  <script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
  <!-- <script src="<?php echo BASE_URL; ?>assets/jquery-3.7.1.min.js"></script> -->
  <script src="<?php echo BASE_URL; ?>assets/jquery-ui.js"></script>

  <script>
    //script para acceder a la constante del archivo Config, mediante js desde las funciones 
    const BASE_URL = "<?php echo BASE_URL; ?>";
  </script>
  <script src="<?php echo BASE_URL; ?>Assets/js/modulos/usuarios/login.js"></script>
  <script src="<?php echo BASE_URL; ?>Assets/js/modulos/alertas.js"></script>
  <script src="<?php echo BASE_URL; ?>Assets/js/sweetalert2.all.min.js"></script>

</body>

</html>