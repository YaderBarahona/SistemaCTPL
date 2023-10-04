<?php
class SeccionModel extends Query
{
  private  $sec,  $id, $SEC_hidden;
  public function __construct()
  {
    //cargar constructor de la clase query
    parent::__construct();
  }

  public function getSecciones()
  {
    $sql = "SELECT sec_id, num_sec FROM secciones";
    $data = $this->selectAll($sql);
    return $data;
  }

  //mostrar la info del estudiante al darle click al boton de editar

  public function postSeccion(string $sec)
  {
    $this->sec = $sec;

    //select para verificar si la seccion ya existe
    $verificarSeccion = "SELECT num_sec FROM secciones WHERE num_sec = '$this->sec'";
    $existe = $this->select($verificarSeccion);

    if (empty($existe)) {
      $sql = "INSERT INTO secciones (num_sec) VALUES (?)";
      $datos = array($this->sec);
      $data = $this->save($sql, $datos);

      if ($data == 1) {
        $res = "OK";
      } else {
        $res = "ERROR";
      }
    } else {
      // $res = "El nombre de usaurio: " . $this->usuario . " ya existe";
      $res = "EXISTE";
    }

    return $res;
  }


  public function getSeccion(int $id)
  {
    // $sql = "SELECT e.est_id, e.ced_est, e.nom_est, e.pa_est, e.sa_est, e.sec_id, s.sec_id, s.num_sec FROM estudiantes e INNER JOIN secciones s WHERE e.sec_id = s.sec_id AND est_id = '$id'";
    $sql = "SELECT sec_id, num_sec FROM secciones WHERE sec_id = $id";
    $data = $this->select($sql);
    return $data;
  }

  public function updateEstudiante(string $sec,  int $id, string $SEC_hidden)
  {
    $this->sec = $sec;
    $this->id = $id;
    $this->SEC_hidden = $SEC_hidden;

    //select para verificar si la cedula del estudiante ya existe
    $verificarEstudiante = "SELECT num_sec FROM secciones WHERE num_sec = '$this->sec' AND num_sec <> '$this->SEC_hidden'";
    $existe = $this->select($verificarEstudiante);
    if (empty($existe)) {
      $sql = "UPDATE secciones SET num_sec = ? WHERE sec_id = ?";
      $datos = array($this->sec, $this->id);
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

  function deleteSeccion(int $id)
  {
    $sql = "DELETE FROM secciones WHERE sec_id = ?";
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
