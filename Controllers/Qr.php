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
}
