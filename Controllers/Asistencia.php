<?php

class Asistencia extends Controller
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

    $verificarPermisoCompleto = $this->model->verificarPermiso($id_user, 'Asistencias');
    $verificarPermisoParcial = $this->model->verificarPermiso($id_user, 'Mostrar Asistencias');

    //verificamos si la consulta tiene algo
    if (!empty($verificarPermisoCompleto) || !empty($verificarPermisoParcial)) {

      $data['permisoReporteAsistencia'] = $this->model->verificarPermiso($id_user, 'Reportes Asistencias');

      //global
      $data['permisoGlobalAsistencia'] = $this->model->verificarPermiso($id_user, 'Asistencias');

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

    $data = $this->model->getAsistencias();

    //enviamos la data en json hacia el js
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
}
