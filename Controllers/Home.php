<?php

//heredando de la clase Controller
class Home extends Controller
{
  public  function __construct()
  {
    session_start();

    //si la sesion no esta vacia 
    if (!empty($_SESSION['activo'])) {
      //redireccionamos al controlador principal
      header("location: " . BASE_URL . "Principal");
    }

    //cargamos constructor de la instancia 
    parent::__construct();
  }
  public function index()
  {
    //accediento a views del controlador
    //pasamos el controlador "$this" y el nombre de la vista (extension ya especificada en el archivo Views.php)
    $this->views->getView($this, "index");
  }
}
