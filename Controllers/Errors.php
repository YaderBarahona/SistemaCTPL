<?php

//heredando de la clase Controller
class Errors extends Controller
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

  public function index()
  {
    //accediento a views del controlador
    //pasamos el controlador "$this" y el nombre de la vista (extension ya especificada en el archivo Views.php)
    $this->views->getView($this, "index");
  }

  public function forbidden()
  {
    //$this en el primer parametro indicamos que el directorio esta creado con el mismo nombre de la clase
    $this->views->getView($this, "forbidden");
  }
}
