<?php
class LogModel extends Query
{
  private  $usuario,  $tipo_acceso,  $navegador,  $ip, $fecha;
  public function __construct()
  {
    //cargar constructor de la clase query
    parent::__construct();
  }

  public function getLog()
  {
    $sql = "SELECT registro_id, usuario, tipo_acceso, navegador, direccion_ip, fecha FROM registro_acceso";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function postLog(string $usuario, string $tipo_acceso, string $navegador, string $ip)
  {
    $this->usuario = $usuario;
    $this->tipo_acceso = $tipo_acceso;
    $this->navegador = $navegador;
    $this->ip = $ip;

    date_default_timezone_set('America/Costa_Rica');
    $this->fecha = date('Y-m-d h:i:s');

    //select para verificar si el nombre de usuario ya existe
    $verificarUsuario = "SELECT nom_us FROM usuarios WHERE nom_us = '$this->usuario'";
    $existe = $this->select($verificarUsuario);

    $sql = "INSERT INTO registro_acceso(usuario, tipo_acceso, navegador, direccion_ip, fecha) 
      VALUES (?,?,?,?,?)";
    $datos = array($this->usuario, $this->tipo_acceso, $this->navegador, $this->ip, $this->fecha);
    $data = $this->save($sql, $datos);

    if ($data == 1) {
      $res = "OK";
    } else {
      $res = "ERROR";
    }

    return $res;
  }

  public function verificarPermiso(int $id_user, string $nombre_permiso)
  {
    $sql = "SELECT p.perm_id, p.tp_perm, 
          rp.rol_id, 
          r.tp_rol
          FROM permisos p 
          INNER JOIN roles_permisos rp ON p.perm_id = rp.perm_id
          INNER JOIN roles r ON rp.rol_id = r.rol_id
          INNER JOIN usuarios u ON u.rol_id = r.rol_id
          WHERE u.us_id = $id_user AND p.tp_perm = '$nombre_permiso'";
    $data = $this->selectAll($sql);
    return $data;
  }
}
