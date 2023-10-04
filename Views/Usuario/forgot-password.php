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
        <h1 class="h4 text-gray-900 mb-2">¿Olvidaste tu contraseña?</h1>
        <p class="mb-5">Lo entendemos, suceden cosas. Sólo tienes que introducir tu dirección de correo electrónico a continuación
          ¡Y te enviaremos un enlace para restablecer tu contraseña!</p>
      </div>

      <input type="email" class="form-control form-control-user" id="inputCorreo" name="inputCorreo" aria-describedby="emailHelp" placeholder="Correo electrónico">
      <!-- <input type="submit" class="login-btn" id="btnLogin" value="Iniciar Sesión" onclick="frmLogin(event);"> -->
      <button type="submit" id="btnLogin" class="login-btn" onclick="frmEnviarCorreo(event);">Enviar</button>

      <!-- <a type="submit" class="boton" id="btnLogin" value="Iniciar Sesión" onclick="frmLogin(event);">Iniciar sesion</a> -->
      <!-- <button type="submit" class="btn btn-primary boton" id="btnLogin" onclick="frmLogin(event);">Iniciar sesion</button> -->
      <!-- <br> -->
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