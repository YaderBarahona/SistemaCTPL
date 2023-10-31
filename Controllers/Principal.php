<?php

//heredando de la clase Controller
class Principal extends Controller
{
  public  function __construct()
  {
    session_start();

    //verificamos si la sesion esta iniciada
    if (empty($_SESSION['activo'])) {
      header("location: " . BASE_URL);
    }

    //cerrar sesion por inactividad
    // if (isset($_SESSION['last_activity'])) {
    //   //tiempo en segundos
    //   $inactive_time = 10;

    //   $current_time = time();
    //   $elapsed_time = $current_time - $_SESSION['last_activity'];

    //   if ($elapsed_time > $inactive_time) {
    //     session_unset();
    //     session_destroy();
    //     header('location: ' . BASE_URL);
    //     exit();
    //   } else {
    //     $_SESSION['last_activity'] = $current_time;
    //   }
    // }

    //cargamos constructor de la instancia 
    parent::__construct();
  }
  public function index()
  {

    //pasamos el id_usuario de la sesion
    $id_user = $_SESSION['id_usuario'];

    $verificarPermisoCompleto = $this->model->verificarPermiso($id_user, 'Panel');

    if (!empty($verificarPermisoCompleto)) {

      $data['totalEstudiantes'] = $this->model->getTotalEstudiantes();
      $data['totalUsuarios'] = $this->model->getTotalUsuarios();
      $data['totalSecciones'] = $this->model->getTotalSecciones();
      $data['totalAsistencias'] = $this->model->getTotalAsistencias();

      //data para el grafico
      $data['dataAsistencia'] =
        $this->model->getDataAsistencia();

      //accedemos a views y al metodo getview
      //pasando por parametros el controlador y el nombre de la vista
      //pasamos la variable data a la vista
      $this->views->getView($this, "index", $data);
    } else {
      header('Location: ' . BASE_URL . 'Errors/forbidden');
    }
  }
}
