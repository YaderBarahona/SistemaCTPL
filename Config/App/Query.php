<?php

class Query extends Conexion
{
  private $pdo, $con, $sql, $datos;
  public function __construct()
  {
    //instanciamos la conexion en el constructor
    $this->pdo = new Conexion();
    //pasamos la instancia de la conexion a la variable con
    //accdememos al metodo conect
    $this->con = $this->pdo->conect();
  }

  //metodo para realizar select hacia mysql
  public function select(string $sql)
  {
    $this->sql = $sql;
    //preparar consulta con el parametro que se pase en la funcion
    $result = $this->con->prepare($sql);
    $result->execute();
    //guardamos la consulta en data e indicamos que solo traiga un registro "fetch(PDO::FETCH_ASSOC)"
    $data = $result->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function selectAll(string $sql)
  {
    $this->sql = $sql;
    //preparar consulta con el parametro que se pase en la funcion
    $result = $this->con->prepare($sql);
    $result->execute();
    //guardamos la consulta en data e indicamos que solo traiga un registro "fetch(PDO::FETCH_ASSOC)"
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function save(string $sql, array $datos)
  {
    $this->sql = $sql;
    $this->datos = $datos;
    $insert = $this->con->prepare($this->sql);
    $data = $insert->execute($this->datos);

    if ($data) {
      $res = 1;
    } else {
      $res = 0;
    }

    return $res;
  }

  public function insertar(string $sql, array $datos)
  {
    $this->sql = $sql;
    $this->datos = $datos;
    $insert = $this->con->prepare($this->sql);
    $data = $insert->execute($this->datos);
    if ($data) {
      $res = $this->con->lastInsertId();
    } else {
      $res = 0;
    }
    return $res;
  }
}
