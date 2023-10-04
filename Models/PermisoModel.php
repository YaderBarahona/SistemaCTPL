<?php
class PermisoModel extends Query
{
  private  $rol,  $descripcion, $id, $ROL_hidden;
  public function __construct()
  {
    //cargar constructor de la clase query
    parent::__construct();
  }

  public function getPermisosCompletos()
  {
    $sql = "SELECT perm_id, tp_perm FROM permisos WHERE especifico = 0";
    $data = $this->selectAll($sql);
    return $data;
  }

  //especifico=1 significa que es un permiso especifico y modulo=1 significa que es el modulo usuarios
  public function getPermisosParcialesUsuario()
  {
    $sql = "SELECT perm_id, tp_perm FROM permisos WHERE especifico = 1 AND modulo = 1";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getPermisosParcialesRoles()
  {
    $sql = "SELECT perm_id, tp_perm FROM permisos WHERE especifico = 1 AND modulo = 2";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getPermisosParcialesPermisos()
  {
    $sql = "SELECT perm_id, tp_perm FROM permisos WHERE especifico = 1 AND modulo = 3";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getPermisosParcialesEstudiantes()
  {
    $sql = "SELECT perm_id, tp_perm FROM permisos WHERE especifico = 1 AND modulo = 4";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getPermisosParcialesSecciones()
  {
    $sql = "SELECT perm_id, tp_perm FROM permisos WHERE especifico = 1 AND modulo = 5";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getPermisosParcialesAsistencias()
  {
    $sql = "SELECT perm_id, tp_perm FROM permisos WHERE especifico = 1 AND modulo = 6";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function postRolPermiso(int $id_rol, int $id_permiso)
  {
    $sql = "INSERT INTO roles_permisos (rol_id, perm_id) VALUES (?,?)";
    $datos = array($id_rol, $id_permiso);
    $data = $this->save($sql, $datos);
    if ($data == 1) {
      $res = "OK";
    } else {
      $res = "ERROR";
    }

    return $res;
  }

  public function deletePermiso(int $id_rol)
  {
    $sql = "DELETE FROM roles_permisos WHERE rol_id = ?";
    $datos = array($id_rol);
    $data = $this->save($sql, $datos);

    //el metodo save retorna 1 en caso de insercion 
    if ($data == 1) {
      $res = "ELIMINADO";
    } else {
      $res = "ERROR";
    }

    return $res;
  }

  public function getDetallePermiso(int $id_rol)
  {
    $sql = "SELECT rp_id, rol_id, perm_id FROM roles_permisos WHERE rol_id = $id_rol";
    $data = $this->selectAll($sql);
    return $data;
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
