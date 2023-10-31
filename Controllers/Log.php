<?php

class Log extends Controller
{
  public function __construct()
  {
    //inicializamos la sesion
    session_start();

    //verificamos si la sesion esta iniciada
    if (empty($_SESSION['activo'])) {
      header("location: " . BASE_URL);
    }

    //cargamos constructor de la instancia (de la vista)
    parent::__construct();
  }

  //metodo index para mostrar la vista
  public function index()
  {
    //pasamos el id_usuario de la sesion
    $id_user = $_SESSION['id_usuario'];

    $verificarPermisoCompleto = $this->model->verificarPermiso($id_user, 'Registro de acceso');

    //verificamos si la consulta tiene algo
    if (!empty($verificarPermisoCompleto)) {

      // $data['permisoReporteRegistro'] = $this->model->verificarPermiso($id_user, 'Reportes Registro de acceso');

      //global
      $data['permisoGlobalRegistro'] = $this->model->verificarPermiso($id_user, 'Registro de acceso');

      //accedemos a views y al metodo getview
      //pasando por parametros el controlador y el nombre de la vista
      //pasamos la variable data a la vista
      $this->views->getView($this, "index", $data);
    } else {
      header('Location: ' . BASE_URL . 'Errors/forbidden');
    }
  }

  public function listar()
  {

    $data = $this->model->getLog();

    //enviamos la data en json hacia el js
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function postLog()
  {

    $usuario = $_POST['inputUser'];
    $tipo_acceso = $_POST['tipo_acceso'];
    $navegador = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!isset($usuario)) {
      //mensaje hacia el js
      $msg = "usuario nulo";
    } else {

      $data = $this->model->postLog($usuario, $tipo_acceso, $navegador, $ip);

      if ($data == "OK") {
        $msg = "OK";
      } else {
        $msg = "ERROR";
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function postLog2()
  {

    $usuario = $_SESSION['usuario'];
    $tipo_acceso = "Cierre de sesión";
    $navegador = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!isset($usuario)) {
      //mensaje hacia el js
      $msg = "usuario nulo";
    } else {

      $data = $this->model->postLog($usuario, $tipo_acceso, $navegador, $ip);

      if ($data == "OK") {
        $msg = "OK";
      } else {
        $msg = "ERROR";
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
