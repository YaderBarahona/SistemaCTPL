<?php
//clase para cargar de forma automatica las clases, en lugar de usar require_once
spl_autoload_register(function ($class) {
  if (file_exists("Config/App/" . $class . ".php")) {
    require_once "Config/App/" . $class . ".php";
  }
});
