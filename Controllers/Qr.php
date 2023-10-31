<?php

//heredando de la clase Controller
class Qr extends Controller
{
  public  function __construct()
  {
    session_start();

    //si la sesion no esta vacia 
    if (empty($_SESSION['activo'])) {
      header("location: " . BASE_URL);
    }

    //cargamos constructor de la instancia 
    parent::__construct();
  }
  public function index()
  {

    //pasamos el id_usuario de la sesion
    $id_user = $_SESSION['id_usuario'];
    $verificarPermisoCompleto = $this->model->verificarPermiso($id_user, 'QR');
    //verificamos si la consulta tiene algo
    if (!empty($verificarPermisoCompleto)) {

      //accedemos a views y al metodo getview
      //pasando por parametros el controlador y el nombre de la vista
      //pasamos la variable data a la vista
      $this->views->getView($this, "index");
    } else {
      header('Location: ' . BASE_URL . 'Errors/forbidden');
    }
  }

  public function verificarAsistencia()
  {
    if (isset($_POST['ced_est'])) {
      $ced_est = $_POST['ced_est'];

      $verificar = $this->model->verificarAsistencia($ced_est);

      if ($verificar == "INGRESADO") {
        $msg = "INGRESADO";
      } else if ($verificar == "NOINGRESADO") {
        $msg = "NOINGRESADO";
      } else {
        $msg = "NOEXISTE";
      }
    } else {
      echo "No se recibió el dato 'ced_est'";
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrarAsistencia()
  {

    if (isset($_POST['ced_est'])) {
      $ced_est = $_POST['ced_est'];

      $data = $this->model->registrarAsistencia($ced_est);

      if ($data == "OK") {
        $msg = "OK";
      } else if ($data == "NOEXISTE") {
        $msg = "NOEXISTE";
      } else {
        $msg = "Error al registrar asistencia";
      }
    } else {
      $msg = "No se recibió el dato 'ced_est'";
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
