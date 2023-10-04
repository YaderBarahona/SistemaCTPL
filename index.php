<?php
//archivo para el enrutado

//requerimos el archivo config.php
require_once "Config/Config.php";

// almacenamos en la variable ruta lo que contenga la variable "url" del archivo htaccess
// si no esta vacia que almacene lo que se le pase luego de "index/" y sino que contenga "home/index"
$ruta = !empty($_GET['url']) ? $_GET['url'] : 'Home/index';

// convertir ruta a arreglo
// delimitador y ruta
$array = explode("/", $ruta); //indice 0 controlador, indice 1 metodo, indice 2 ... n parametros

//indice 0 controlador
$controller = $array[0];

//metodo por defecto
$metodo = "index";

//variable para los parametros de la ruta
$parametro = "";

//validamos posicion 1 del array
if (!empty($array[1])) {
  if (!empty($array[1] != "")) {
    $metodo = $array[1];
  }
}

//validamos posicion 2 del array
if (!empty($array[2])) {
  if (!empty($array[2] != "")) {
    //recorremos el array
    for ($i = 2; $i < count($array); $i++) {
      //acumulamos los parametros
      $parametro .= $array[$i] . ",";
    }
    //metodo trim para quitar ultima coma ","
    $parametro = trim($parametro, ",");
  }
}

//
require_once "Config/App/Autoload.php";

//variable para guardar la ruta de la carpeta controllers
$dirController = "Controllers/" . $controller . ".php";

//verficamos si existe el controlador en el directorio
if (file_exists($dirController)) {
  //requerimos el controlador
  require_once $dirController;

  //instancia de controlador
  $controller = new $controller();

  //verificar si existe un metodo dentro del controlador
  if (method_exists($controller, $metodo)) {
    //accedemos al metodo y a los parametros si tiene
    $controller->$metodo($parametro);
  } else {
    // echo "No existe el metodo";
    header("location: " . BASE_URL . 'Errors');
  }
} else {
  // echo "No existe el controlador";
  header("location: " . BASE_URL . 'Errors');
}
