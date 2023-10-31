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
  <link href="https://fonts.googleapis.com/css2?family=Prata&family=Raleway&display=swap" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo BASE_URL; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/modulos/login.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/modulos/btn.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/modulos/boton.css">

  <meta name="google-signin-client_id" content="852842117575-dhnj541v1q5mo34gi6qfldejpj7mgfi9.apps.googleusercontent.com">
  <title>Iniciar Sesión</title>
</head>

<body>

  <div class="container-form sign-in">
    <form class="formulario" id="frmLogin">
      <h2 class="create-account">¡Bienvenido!</h2>
      <input type="hidden" name="tipo_acceso" value="Inicio de sesión">
      <input type="text" class="form-control form-control-user" id="inputUser" name="inputUser" aria-describedby="emailHelp" placeholder="Nombre de usuario">
      <input type="password" class="form-control form-control-user" id="inputPassword" name="inputPassword" placeholder="Contraseña">
      <!-- <input type="submit" class="login-btn" id="btnLogin" value="Iniciar Sesión" onclick="frmLogin(event);"> -->
      <button type="submit" id="btnLogin" class="login-btn" onclick="frmLogin(event);">Login</button>

      <!-- <a type="submit" class="boton" id="btnLogin" value="Iniciar Sesión" onclick="frmLogin(event);">Iniciar sesion</a> -->
      <!-- <button type="submit" class="btn btn-primary boton" id="btnLogin" onclick="frmLogin(event);">Iniciar sesion</button> -->
      <!-- <br> -->

      <!-- <hr style="border-style: inset; border-width: 1px;">
      <div id="my-signin2"></div>
      <div id="content">
      </div> -->

      <hr style="border-style: inset; border-width: 1px;">
      <!-- <br> -->
      <div class=" text-center">
        <a class="small" style="color: white; text-decoration: none;" href="<?php echo BASE_URL; ?>Usuario/forgotPassword">¿Olvidó su contraseña?</a>
      </div>
    </form>
  </div>

  <script>
    function onSuccess(googleUser) {
      console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
    }

    function onFailure(error) {
      console.log(error);
    }

    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 280,
        'height': 50,
        'longtitle': true,
        'theme': 'light',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });
    }
  </script>

  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>

  <script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
  <!-- <script src="<?php echo BASE_URL; ?>assets/jquery-3.7.1.min.js"></script> -->
  <script src="<?php echo BASE_URL; ?>assets/jquery-ui.js"></script>

  <script>
    //script para acceder a la constante del archivo Config, mediante js desde las funciones 
    const BASE_URL = "<?php echo BASE_URL; ?>";
  </script>

  <script src="<?php echo BASE_URL; ?>assets/js/modulos/usuarios/login.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/modulos/alertas.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/sweetalert2.all.min.js"></script>

</body>

</html>