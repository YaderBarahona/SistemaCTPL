<?php
class Conexion
{
  private $conn;
  public function __construct()
  {
    //establecer conexion con mysql concatenando las constante del archivo config
    $pdo = "mysql:host=" . host . ";dbname=" . db . ";" . charset;
    try {
      //instancia de conexion PDO
      $this->conn = new PDO($pdo, user, password);
      //capturar errores
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      //mensaje con el error de la exepcion
      echo "Error en la conexión" . $e->getMessage();
    }
  }

  public function conect()
  {
    return $this->conn;
  }
}
