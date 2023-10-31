<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Usuario extends Controller
{

  public function __construct()
  {
    //inicializamos la sesion
    session_start();

    //cargamos constructor de la instancia (de la vista)
    parent::__construct();
  }

  //metodo index para mostrar la vista
  public function index()
  {
    //verificamos si la sesion esta iniciada
    if (empty($_SESSION['activo'])) {
      header("location: " . BASE_URL . "Principal");
    }

    // } else {
    //   if ((time() - $_SESSION['time']) > 60) {
    //     session_destroy();
    //     header("location: " . BASE_URL);
    //   }
    // }

    // session_start();
    // if (!isset($_SESSION['user_id'])) {
    //   header('location:index.php');
    // } else {
    //   if ((time() - $_SESSION['time']) > 60) {
    //     header('location: logout_page.php');
    //   }
    // }

    //pasamos el id_usuario de la sesion
    $id_user = $_SESSION['id_usuario'];

    $verificarPermisoCompleto = $this->model->verificarPermiso($id_user, 'Usuarios');
    $verificarPermisoParcial = $this->model->verificarPermiso($id_user, 'Mostrar Usuarios');

    //verificamos si la consulta tiene algo
    if (!empty($verificarPermisoCompleto) || !empty($verificarPermisoParcial)) {
      $data['roles'] = $this->model->getRoles();

      $data['permisoCrearUsuario'] = $this->model->verificarPermiso($id_user, 'Crear Usuario');
      // $reporte = $this->model->verificarPermiso($id_user, 'Reportes Usuario');
      // $data['permisoReporteUsuario'] = $reporte['tp_perm'];
      $data['permisoReporteUsuario'] = $this->model->verificarPermiso($id_user, 'Reportes Usuarios');

      //global
      $data['permisoGlobalUsuario'] = $this->model->verificarPermiso($id_user, 'Usuarios');

      //accedemos a views y al metodo getview
      //pasando por parametros el controlador y el nombre de la vista
      //pasamos la variable data a la vista
      $this->views->getView($this, "index", $data);
    } else {
      header('Location: ' . BASE_URL . 'Errors/forbidden');

      //mandarlo a la vista sin la data si no tiene el permiso o mandamos la data vacia para verificar en el index
      // $data['cajas'] = '';
      // $this->views->getView($this, "index", $data);
    }
  }

  public function validar()
  {
    //almacenamos los valores en variables
    $user = $_POST['inputUser'];
    $password = $_POST['inputPassword'];
    $hash = hash("SHA256", $password);

    //verificar si lo que se esta enviando mediante post en los inputs del formulario estan vacios
    if (empty($_POST['inputUser'])) {
      $msg = "Usuario vacio";
    } else if (empty($_POST['inputPassword'])) {
      $msg = "Contraseña bacia";
    } else {
      //consulta
      $data1 = $this->model->getEstado($user);

      if (empty($data1)) {
        $msg = "ERROR";
      } else {

        // print_r($hash);
        //consulta
        $data2 = $this->model->getUsuario($user, $hash);

        //verificacion de que data contenga los valores de la consulta 
        if ($data2) {
          //sesiones
          //accedemos mediante data al id del usuario en la db y lo guardamos en la sesion como id_usuario
          $_SESSION['id_usuario'] = $data2['us_id'];
          $_SESSION['usuario'] = $data2['nom_us'];
          $_SESSION['correo'] = $data2['cor_us'];
          $_SESSION['activo'] = true;
          $_SESSION['rol_usuario'] = $data2['rol_id'];

          // $_SESSION['last_activity'] = time();

          //guardando permisos en las sesiones

          //

          $permisoCompletoPanel = $this->model->verificarPermiso($data2['us_id'], 'Panel');

          $_SESSION['permisoCompletoPanel'] = $permisoCompletoPanel;

          //

          $permisoCompletoUsuario = $this->model->verificarPermiso($data2['us_id'], 'Usuarios');
          $permisoParcialMostrarUsuario = $this->model->verificarPermiso($data2['us_id'], 'Mostrar Usuarios');

          $_SESSION['permisoCompletoUsuario'] = $permisoCompletoUsuario;
          $_SESSION['permisoParcialMostrarUsuario'] = $permisoParcialMostrarUsuario;

          //

          $permisoCompletoRoles = $this->model->verificarPermiso($data2['us_id'], 'Roles');
          $permisoParcialMostrarRoles = $this->model->verificarPermiso($data2['us_id'], 'Mostrar Roles');

          $_SESSION['permisoCompletoRoles'] = $permisoCompletoRoles;
          $_SESSION['permisoParcialMostrarRoles'] = $permisoParcialMostrarRoles;

          // extra permisos

          $permisoCompletoPermisos = $this->model->verificarPermiso($data2['us_id'], 'Permisos');
          $permisoParcialMostrarPermisos = $this->model->verificarPermiso($data2['us_id'], 'Mostrar Permisos');

          $_SESSION['permisoCompletoPermisos'] = $permisoCompletoPermisos;
          $_SESSION['permisoParcialMostrarPermisos'] = $permisoParcialMostrarPermisos;

          //

          $permisoCompletoEstudiantes = $this->model->verificarPermiso($data2['us_id'], 'Estudiantes');
          $permisoParcialMostrarEstudiantes = $this->model->verificarPermiso($data2['us_id'], 'Mostrar Estudiantes');

          $_SESSION['permisoCompletoEstudiantes'] = $permisoCompletoEstudiantes;
          $_SESSION['permisoParcialMostrarEstudiantes'] = $permisoParcialMostrarEstudiantes;

          //

          $permisoCompletoSecciones = $this->model->verificarPermiso($data2['us_id'], 'Secciones');
          $permisoParcialMostrarSecciones = $this->model->verificarPermiso($data2['us_id'], 'Mostrar Secciones');

          $_SESSION['permisoCompletoSecciones'] = $permisoCompletoSecciones;
          $_SESSION['permisoParcialMostrarSecciones'] = $permisoParcialMostrarSecciones;

          //

          $permisoCompletoAsistencias = $this->model->verificarPermiso($data2['us_id'], 'Asistencias');
          $permisoParcialMostrarAsistencias = $this->model->verificarPermiso($data2['us_id'], 'Mostrar Asistencias');

          $_SESSION['permisoCompletoAsistencias'] = $permisoCompletoAsistencias;
          $_SESSION['permisoParcialMostrarAsistencias'] = $permisoParcialMostrarAsistencias;

          //

          $permisoCompletoQR = $this->model->verificarPermiso($data2['us_id'], 'QR');

          $_SESSION['permisoCompletoQR'] = $permisoCompletoQR;

          $msg = "OK";
        } else {
          $msg = "Contraseña incorrecta";
        }
      }
    }

    // print_r($data);

    //mostrar la respuesta de $msg y enviarla al js
    //JSON_UNESCAPED_UNICODE para los caracteres especiales
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    //imprimir lo que se esta enviando por el metodo POST
    // print_r($_POST);
    //cortamos la peticion
    die();
  }

  public function listar()
  {
    // print_r($this->model->getUsuarios());

    $data = $this->model->getUsuarios();

    $id_user = $_SESSION['id_usuario'];

    $verificarPermisoCompletoUsuario = $this->model->verificarPermiso($id_user, 'Usuarios');
    $verificarPermisoActualizarUsuario = $this->model->verificarPermiso($id_user, 'Editar Usuario');
    $verificarPermisoEliminarUsuario = $this->model->verificarPermiso($id_user, 'Eliminar Usuario');
    $verificarPermisoActivarUsuario = $this->model->verificarPermiso($id_user, 'Activar Usuario');
    $verificarPermisoDesactivarUsuario = $this->model->verificarPermiso($id_user, 'Desactivar Usuario');

    //
    for ($i = 0; $i < count($data); $i++) {
      if ($data[$i]['activo'] == 1) {
        //colocamos en el campo estado de cada usuario un span success de bts
        $data[$i]['activo'] = '<span class="badge bg-success">Activo</span>';

        if ((!empty($verificarPermisoActualizarUsuario) && !empty($verificarPermisoEliminarUsuario) && !empty($verificarPermisoDesactivarUsuario)) || !empty($verificarPermisoCompletoUsuario)) {
          $data[$i]['acciones'] = '<div>
          
        <button style="margin: 5px" class="btn btn-primary" type="button" onClick="btnEditarUser(' . $data[$i]['us_id'] . ');"><i class="fas fa-user-edit"></i></button> 
        <button style="margin: 5px" class="btn btn-warning" type="button"  onClick="btnDesactivarUser(' . $data[$i]['us_id'] . ');"><i class="fas fa-lock"></i></button>
        <button style="margin: 5px" class="btn btn-danger" type="button"  onClick="btnEliminarUser(' . $data[$i]['us_id'] . ');"><i class="fas fa-trash"></i></button>
        </div>';
        } else if (!empty($verificarPermisoActualizarUsuario)) {
          $data[$i]['acciones'] = '<div>
        <button class="btn btn-primary" type="button" onClick="btnEditarUser(' . $data[$i]['us_id'] . ');"><i class="fas fa-user-edit"></i></button>
        </div>';
        } else if (!empty($verificarPermisoEliminarUsuario)) {
          $data[$i]['acciones'] = '<div>
        <button class="btn btn-danger" type="button"  onClick="btnEliminarUser(' . $data[$i]['us_id'] . ');"><i class="fas fa-trash"></i></button>
        </div>';
        } else if (!empty($verificarPermisoDesactivarUsuario)) {
          $data[$i]['acciones'] = '<div>
        <button class="btn btn-danger" type="button"  onClick="btnDesactivarUser(' . $data[$i]['us_id'] . ');"><i class="fas fa-lock"></i></button>
        </div>';
        } else {
          $data[$i]['acciones'] = '<div>
        <span class="badge bg-info">Usuario sin acciones</span>
        </div>';
        }
      } else {

        $data[$i]['activo'] = '<span class="badge bg-danger">Inactivo</span>';

        if (!empty($verificarPermisoActivarUsuario) || !empty($verificarPermisoCompletoUsuario)) {
          $data[$i]['acciones'] = '<div>
      <button class="btn btn-success" type="button"  onClick="btnActivarUser(' . $data[$i]['us_id'] . ');"><i class="fas fa-unlock-alt"></i></button>
      </div>';
        } else {
          $data[$i]['acciones'] = '<div>
          <span class="badge bg-info">Usuario sin acciones</span>      
          </div>';
        }
      }
    }

    //enviamos la data en json hacia el js
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrarUsuario()
  {

    $usuario = $_POST['inputUsuario'];
    $patronUser = '/^[a-zA-Z0-9\_\-]{5,30}$/';

    $correo = $_POST['inputCorreo'];
    $patronCorreo = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+[a-zA-Z0-9-]{1,61}[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]{2,63}$/';

    $password = $_POST['inputPassword'];
    $patronPass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,100}$/';

    $confirmPassword = $_POST['inputConfirmPassword'];

    $selectRol = $_POST['selectRol'];

    $id = $_POST['id_hidden'];

    $USUARIO_HIDDEN = $_POST['USUARIO_HIDDEN'];

    $CORREO_HIDDEN = $_POST['CORREO_HIDDEN'];

    $hash = hash("SHA256", $password);

    if (empty($usuario) || empty($correo) || empty($password) || empty($confirmPassword)) {
      $msg = "Todos los campos son obligatorios";
    } else {
      if ($id == '') {
        if (!preg_match($patronUser, $usuario)) {
          $msg = "El campo usuario permite ingresar entre 5 y 30 caracteres, solo admite letras, numeros, guion y guion bajo, no se permiten carácteres especiales ni espacios.";
        } else if (!preg_match($patronCorreo, $correo)) {
          $msg = "El correo eléctronico permite ingresar entre 8 y 50 caracteres ademas debe contener el simbolo de arroba '@' seguido del dominio y por ultimo una extensión (.com,.co,etc).";
        } else if (!preg_match($patronPass, $password)) {
          $msg = "La contraseña debe contener una letra minúscula, una letra mayúscula, un dígito, un carácter especial ademas la longitud mínima es de 8 caracteres y la longitud máxima es de 100 caracteres.";
        } else if ($password != $confirmPassword) {
          $msg = "Las contraseñas no coinciden";
        } else {
          $data = $this->model->insertarUsuario($usuario, $correo, $hash, $selectRol);
          if ($data == "EXISTE_USUARIO") {
            $msg = "EXISTE_USUARIO";
          } else if ($data == "EXISTE_CORREO") {
            $msg = "EXISTE_CORREO";
          } else if($data == "OK"){
            $msg = "OK";
          } else {
            $msg = "ERROR";
          }
        }
      } else {
        if (!preg_match($patronUser, $usuario)) {
          $msg = "El campo usuario permite ingresar entre 5 y 30 caracteres, solo admite letras, numeros, guion y guion bajo, no se permiten carácteres especiales ni espacios.";
        } else if (!preg_match($patronCorreo, $correo)) {
          $msg = "El correo eléctronico permite ingresar entre 8 y 50 caracteres ademas debe contener el simbolo de arroba '@' seguido del dominio y por ultimo una extensión (.com,.co,etc).";
        } else {
          $data = $this->model->actualizarUsuario2($usuario, $correo, $id, $selectRol, $USUARIO_HIDDEN, $CORREO_HIDDEN);
          if ($data == "EXISTE_USUARIO") {
            $msg = "EXISTE_USUARIO";
          } else if($data == "EXISTE_CORREO"){
            $msg = "EXISTE_CORREO";
          } else if($data == "MODIFICADO"){
            $msg = "MODIFICADO";
          } else {
            $msg = "ERROR";
          }
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function editarUsuario(int $id)
  {
    // print_r($id);

    $data = $this->model->actualizarUsuario($id);
    // print_r($data);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function deleteUsuario(int $id)
  {
    // print_r($id);
    $data = $this->model->deleteUsuario($id);
    if ($data == "OK") {
      $msg = "OK";
    } else {
      $msg = "Error al eliminar el usuario";
    }
    // print_r($data);
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function desactivarUsuario(int $id)
  {
    // print_r($id);
    $data = $this->model->accionUsuario(0, $id);
    if ($data == 1) {
      $msg = "OK";
    } else {
      $msg = "Error al eliminar el desactivar";
    }
    // print_r($data);
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function activarUsuario(int $id)
  {
    // print_r($id);
    $data = $this->model->accionUsuario(1, $id);
    if ($data == 1) {
      $msg = "OK";
    } else {
      $msg = "Error al reactivar el usuario";
    }
    // print_r($data);
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  // {
  //   // print_r($id);
  //   $data = $this->model->eliminarUsuario($id);
  //   if ($data == 1) {
  //     $msg = "OK";
  //   } else {
  //     $msg = "Error al eliminar el usuario";
  //   }
  //   // print_r($data);
  //   echo json_encode($msg, JSON_UNESCAPED_UNICODE);
  //   die();
  // }

  //   public function activarUsuario(int $id)
  //   {
  //     // print_r($id);
  //     $data = $this->model->activarUsuario($id);
  //     if ($data == 1) {
  //       $msg = "OK";
  //     } else {
  //       $msg = "Error al reactivar el usuario";
  //     }
  //     // print_r($data);
  //     echo json_encode($msg, JSON_UNESCAPED_UNICODE);
  //     die();
  //   }
  // }

  public function cerrarSesion()
  {
    session_destroy();
    header("location: " . BASE_URL);
  }

  function updatePassword()
  {
    //almacenamos los valores en variables
    $passActual = $_POST['passActual'];
    $passNueva = $_POST['passNueva'];
    $passConfirm = $_POST['passConfirm'];

    $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,100}$/';

    // if(isset($passActual)){
    //   print_r("Definida");
    // } else {
    //   print_r("No Definida");

    // }

    //verificar si lo que se esta enviando mediante post en los inputs del formulario estan vacios
    if (empty($passActual) || empty($passNueva) || empty($passConfirm)) {
      $msg = "Campos vacíos";
      
    } else {
      if (!preg_match($patron, $passNueva)) {
        $msg = "La contraseña debe contener una letra minúscula, una letra mayúscula, un dígito, un carácter especial ademas la longitud mínima es de 8 caracteres y la longitud máxima es de 100 caracteres.";
        // } else if (preg_match($patron, $passConfirm)) {
        //   $msg = "La contraseña debe contener una letra minúscula, una letra mayúscula, un dígito, carácter especial ademas la longitud mínima es de 8 caracteres y la longitud máxima es de 100 caracteres.";
      } else {
        if ($passNueva != $passConfirm) {
          // $msg = "La contraseña nueva no coincide con el campo de confirmación";
          $msg = "ERROR1";
        } else {
          //verificar que el usuario que esta cambiando la contraseña sea de la sesion actual
          $id = $_SESSION['id_usuario'];
          $hash = hash("SHA256", $passActual);
          $data = $this->model->getPass($hash, $id);
          // print_r($data);
          // exit;

          if (!empty($data)) {

            $verificar = $this->model->actualizarPass(hash("SHA256", $passNueva), $id);
            if ($verificar == 1) {
              // $msg = "Contraseña actualizada con éxito";
              $msg = "OK";
            } else {
              // $msg = "Error al actualizar la contraseña";
              $msg = "ERROR2";
            }
          } else {
            // $msg = "Contraseña actual incorrecta";
            $msg = "ERROR3";
          }
          echo json_encode($msg, JSON_UNESCAPED_UNICODE);
          die();
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  function forgotPassword()
  {
    $this->views->getView($this, "forgot-password");
  }

  function recoverPassword()
  {
    $this->views->getView($this, "recover-password");
  }

  public function enviarCorreo()
  {
    var_dump($_POST['inputCorreo']);
    $email = $_POST['inputCorreo'];
    $patronCorreo = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+[a-zA-Z0-9-]{1,61}[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]{2,63}$/';

    //verificar si no esta vacio
    if (!empty($email)) {
      //si no hace match con el patron
      if (!preg_match($patronCorreo, $email)) {
        // $msg = "El correo eléctronico permite ingresar entre 8 y 50 caracteres ademas debe contener el simbolo de arroba '@' seguido del dominio y por ultimo una extensión (.com,.co,etc).";
        $msg = "ERROR2";
      } else {

        //verificamos si el correo se encuentra en la base de datos
        $valido = $this->model->verificarCorreo($email);

        if (!empty($valido)) {
          // Generar un token único
          $token = bin2hex(random_bytes(16));

          date_default_timezone_set('America/Costa_Rica');
          // Guardar el token en la base de datos junto con la fecha de expiración
          $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

          $guardado = $this->model->guardarToken($email, $token, $expira);

          if ($guardado) {
            $mail = new PHPMailer(true);

            try {
              // Configurar el servidor SMTP
              $mail->SMTPDebug = 0;
              $mail->isSMTP();
              $mail->Host       = HOST_SMTP;
              $mail->SMTPAuth   = true;
              $mail->Username   = USER_SMTP;
              $mail->Password   = PASSWORD_SMTP;
              // $mail->SMTPSecure = 'tls'; // Puede ser 'ssl' o 'tls'
              // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; -> port 587
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
              $mail->Port       = PUERTO_SMTP;

              // Configurar el remitente y destinatario
              $mail->setFrom(USER_SMTP, 'SCCTPL');
              $mail->addAddress($email);

              // Contenido del correo
              $mail->isHTML(true);
              $mail->Subject = 'Recuperación de Contraseña';
              // Construir el enlace de recuperación
              $enlace = BASE_URL . "Usuario/recoverPassword?email=$email&token=$token";

              // Cuerpo del correo electrónico
              $mensaje = "Hola,<br>";
              $mensaje .= "Hemos recibido una solicitud para restablecer tu contraseña. <br>Para continuar, haz clic en el siguiente enlace:";
              $mensaje .= "$enlace <br>";
              $mensaje .= "Si no solicitaste este cambio, por favor ignora este mensaje.<br>";
              $mensaje .= "Atentamente, <br>Equipo de soporte software SCCTPL";

              $mail->Body    = $mensaje;

              $mail->CharSet = 'UTF-8';

              $mail->send();
              $msg = "OK";
            } catch (Exception $e) {
              $msg = "ERROR3";
            }
          } else {
            // $msg =  "Hubo un error al guardar el token. Por favor, intenta de nuevo más tarde.";
            $msg = "ERROR4";
          }
        } else {
          // $msg = "El correo digitado no se encuentra registrado, por favor digita un correo electrónico que se encuentre asociado a tu cuenta"
          $msg = "INVALIDO";
        }
      }
    } else {
      $msg = "ERROR1";
    }
    echo json_encode(
      $msg,
      JSON_UNESCAPED_UNICODE
    );
    die();
  }

  function recuperarPassword()
  {

    // $msg = "";

    // if (isset($_GET['token'])) {
    $email = $_POST['email'];
    $token = $_POST['token'];

    $data = $this->model->verificarToken($email, $token);

    if ($data == true) {
      // El token es válido, permitir al usuario cambiar la contraseña

      $password = $_POST['inputPass'];
      //patron
      $patronPass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,100}$/';

      if (!preg_match($patronPass, $password)) {
        // $msg = "Patron invalido";
        $msg = "ERROR1";
      } else {
        $data2 = $this->model->updatePassword($email, $password);
        if ($data2 == "MODIFICADO") {
          // $msg = "Contraseña actualizada correctamente.";
          $msg = "OK";
        } else {
          // $msg = "Error al actualizar contraseña";
          $msg = "ERROR2";
        }
      }
    } else {
      // $msg = "Token inválido o expirado. Por favor, solicita un nuevo enlace de recuperación de contraseña.";
      $msg = "ERROR3";
    }
    // }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  // function gmail()
  // {

  //   // Configuración de la API
  //   $client = new Google_Client(['client_id' => '852842117575-dhnj541v1q5mo34gi6qfldejpj7mgfi9.apps.googleusercontent.com']);
  //   $client->setAuthConfig(BASE_URL . 'assets/js/modulos/credenciales.json'); // Reemplaza con la ubicación de tus credenciales JSON

  //   // Verifica el token
  //   $token = $_POST['id_token']; // Obtén el token de la petición POST

  //   try {
  //     $payload = $client->verifyIdToken($token);
  //     if ($payload) {
  //       $email = $payload['email'];

  //       // Verifica si el correo tiene el dominio de Gmail y si está en tu base de datos
  //       if (filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, '@gmail.com') !== false) {
  //         // El correo tiene el dominio de Gmail, procede a iniciar sesión o registrar al usuario
  //         // Puedes redirigir al usuario a una página de bienvenida o realizar otras acciones según tu lógica de aplicación
  //         // También puedes establecer una sesión o cookie para mantener al usuario autenticado
  //         echo "Inicio de sesión exitoso!";
  //       } else {
  //         echo "El correo no cumple con los criterios de autenticación.";
  //       }
  //     }
  //   } catch (Exception $e) {
  //     echo 'Excepción: ' . $e->getMessage();
  //   }
  // }

  function perfil()
  {
    $id_usuario = $_SESSION['id_usuario'];

    $data = $this->model->getPerfil($id_usuario);

    //verificamos si la sesion esta iniciada
    if (empty($_SESSION['activo'])) {
      header("location: " . BASE_URL . "Principal");
    }

    $this->views->getView($this, "perfil", $data);
  }

  function listaTareas()
  {
    //verificamos si la sesion esta iniciada
    if (empty($_SESSION['activo'])) {
      header("location: " . BASE_URL . "Principal");
    }

    $this->views->getView($this, "lista-tareas");
  }

  function updatePerfil()
  {
    //almacenamos los valores en variables
    $usuario = $_POST['inputUsuario'];
    $patronUser = '/^[a-zA-Z0-9\_\-]{5,30}$/';

    $correo = $_POST['inputCorreo'];
    $patronCorreo = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+[a-zA-Z0-9-]{1,61}[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]{2,63}$/';

    $id = $_POST['id_hidden'];

    $USUARIO_HIDDEN = $_POST['USUARIO_HIDDEN'];

    $CORREO_HIDDEN = $_POST['CORREO_HIDDEN'];

    if (empty($usuario) || empty($correo)) {
      $msg = "Todos los campos son obligatorios";
    } else {
      if (!preg_match($patronUser, $usuario)) {
        $msg = "El campo usuario permite ingresar entre 5 y 30 caracteres, solo admite letras, numeros, guion y guion bajo, no se permiten carácteres especiales ni espacios.";
      } else if (!preg_match($patronCorreo, $correo)) {
        $msg = "El correo eléctronico permite ingresar entre 8 y 50 caracteres ademas debe contener el simbolo de arroba '@' seguido del dominio y por ultimo una extensión (.com,.co,etc).";
      } else {
        $data = $this->model->updatePerfil($usuario, $correo, $id, $USUARIO_HIDDEN, $CORREO_HIDDEN);
        if ($data == "EXISTE_USUARIO") {
          $msg = "EXISTE_USUARIO";
        } else if($data == "EXISTE_CORREO"){
          $msg = "EXISTE_CORREO";
        } else if($data == "MODIFICADO"){
          $msg = "MODIFICADO";
        } else {
          $msg = "ERROR";
        }
      }
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
