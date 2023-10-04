<?php
class Controller
{

  protected $views, $model;

  public function __construct()
  {
    //instancia de la vista al controlador
    $this->views = new Views();
    //llamada del metodo cargarModel dentro del constructor
    $this->cargarModel();
  }
  public function cargarModel()
  {
    //guardamos el nombre de la clase de cada controlador 
    //concatenando el nombre del modelo
    $model = get_class($this) . "Model";

    //ruta del modelo 
    $ruta = "Models/" . $model . ".php";

    //validacion si existe el archivo
    if (file_exists($ruta)) {
      //requerimos
      require_once $ruta;
      //instancia
      $this->model = new $model();
    }
  }
}
