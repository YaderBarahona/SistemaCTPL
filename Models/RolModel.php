<?php
class RolModel extends Query
{
  private  $rol,  $descripcion, $id, $ROL_hidden;
  public function __construct()
  {
    //cargar constructor de la clase query
    parent::__construct();
  }

  public function getRoles()
  {
    $sql = "SELECT rol_id, tp_rol, desc_rol FROM roles";
    $data = $this->selectAll($sql);
    return $data;
  }

  //mostrar la info del estudiante al darle click al boton de editar

  public function postRol(string $rol, string $descripcion)
  {
    $this->rol = $rol;
    $this->descripcion = $descripcion;

    //select para verificar si el rol ya existe
    $verificarRol = "SELECT tp_rol FROM roles WHERE tp_rol = '$this->rol'";
    $existe = $this->select($verificarRol);

    if (empty($existe)) {
      $sql = "INSERT INTO roles (tp_rol, desc_rol) VALUES (?,?)";
      $datos = array($this->rol, $this->descripcion);
      $data = $this->save($sql, $datos);

      if ($data == 1) {
        $res = "OK";
      } else {
        $res = "ERROR";
      }
    } else {
      $res = "EXISTE";
    }

    return $res;
  }


  public function getRol(int $id)
  {
    $sql = "SELECT rol_id, tp_rol, desc_rol FROM roles WHERE rol_id = '$id'";
    $data = $this->select($sql);
    return $data;
  }



  public function updateRol(string $rol, string $descripcion, int $id, string $ROL_hidden)
  {
    $this->rol = $rol;
    $this->descripcion = $descripcion;

    $this->id = $id;
    $this->ROL_hidden = $ROL_hidden;

    //select para verificar si el tipo de rol ya existe
    $verificarRol = "SELECT tp_rol FROM roles WHERE tp_rol = '$this->rol' AND tp_rol <> '$this->ROL_hidden'";
    $existe = $this->select($verificarRol);
    if (empty($existe)) {
      $sql = "UPDATE roles SET tp_rol = ?, desc_rol = ? WHERE rol_id = ?";
      $datos = array($this->rol, $this->descripcion, $this->id);
      $data = $this->save($sql, $datos);

      if ($data == 1) {
        $res = "MODIFICADO";
      } else {
        $res = "ERROR";
      }
    } else {
      // $res = "El nombre de usaurio: " . $this->usuario . " ya existe";
      $res = "EXISTE";
    }

    return $res;
  }

  function deleteRol(int $id)
  {
    $sql = "DELETE FROM roles WHERE rol_id = ?";
    $datos = array($id);
    $data = $this->save($sql, $datos);

    //el metodo save retorna 1 en caso de insercion o eliminacion
    if ($data == 1) {
      $res = "OK";
    } else {
      $res = "ERROR";
    }

    return $res;
  }


  public function getPermisos()
  {
    $sql = "SELECT perm_id, tp_perm, desc_perm FROM permisos";
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
