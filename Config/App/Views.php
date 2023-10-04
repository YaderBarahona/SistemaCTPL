<?php

class Views
{

  //metodo para mostrar la vista
  //recibe un controlador y el nombre de la vista y un parametro data por si se necesita
  public function getView($controlador, $vista, $data = "")
  {
    //nombre de la clase con el parametro controlador
    $controlador = get_class($controlador);

    //verificamos si el controlador es igual a home
    if ($controlador == "Home") {
      //indicamos a la vista que va a acceder
      $vista = "Views/" . $vista . ".php";
    } else {
      $vista = "Views/" . $controlador . "/" . $vista . ".php";
    }

    //requerimos la vista
    require $vista;
  }
}
