<?php
class EstudianteModel extends Query
{
  private  $ced,  $nombre,  $pa,  $sa, $seccion, $id, $CED_hidden;
  public function __construct()
  {
    //cargar constructor de la clase query
    parent::__construct();
  }

  public function getSecciones()
  {
    $sql = "SELECT sec_id, num_sec FROM secciones ORDER BY sec_id ASC";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getEstudiantes()
  {
    $sql = "SELECT e.est_id, e.ced_est, e.nom_est, e.pa_est, e.sa_est, e.sec_id, s.sec_id, s.num_sec FROM estudiantes e INNER JOIN secciones s WHERE e.sec_id = s.sec_id";
    $data = $this->selectAll($sql);
    return $data;
  }

  //mostrar la info del estudiante al darle click al boton de editar

  public function postEstudiante(string $ced, string $nombre, string $pa, string $sa, string $seccion)
  {
    $this->ced = $ced;
    $this->nombre = $nombre;
    $this->pa = $pa;
    $this->sa = $sa;
    $this->seccion = $seccion;

    //select para verificar si la cedula del estudiante ya existe
    $verificarEstudiante = "SELECT ced_est FROM estudiantes WHERE ced_est = '$this->ced'";
    $existe = $this->select($verificarEstudiante);

    if (empty($existe)) {
      $sql = "INSERT INTO estudiantes (ced_est, nom_est, pa_est, sa_est, sec_id) VALUES (?,?,?,?,?)";
      $datos = array($this->ced, $this->nombre, $this->pa, $this->sa, $this->seccion);
      $data = $this->save($sql, $datos);
      // $data = $this->insertar($sql, $datos);
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


  public function getEstudiante(int $id)
  {
    // $sql = "SELECT e.est_id, e.ced_est, e.nom_est, e.pa_est, e.sa_est, e.sec_id, s.sec_id, s.num_sec FROM estudiantes e INNER JOIN secciones s WHERE e.sec_id = s.sec_id AND est_id = '$id'";
    $sql = "SELECT est_id, ced_est, nom_est, pa_est, sa_est, sec_id FROM estudiantes WHERE est_id = '$id'";
    $data = $this->select($sql);
    return $data;
  }

  public function updateEstudiante(string $ced, string $nombre, string $pa, string $sa, string $seccion, int $id, string $CED_hidden)
  {
    $this->ced = $ced;
    $this->nombre = $nombre;
    $this->pa = $pa;
    $this->sa = $sa;
    $this->seccion = $seccion;

    $this->id = $id;
    $this->CED_hidden = $CED_hidden;

    //select para verificar si la cedula del estudiante ya existe
    $verificarEstudiante = "SELECT ced_est FROM estudiantes WHERE ced_est = '$this->ced' AND ced_est <> '$this->CED_hidden'";
    $existe = $this->select($verificarEstudiante);
    if (empty($existe)) {
      $sql = "UPDATE estudiantes SET ced_est = ?, nom_est = ?, pa_est = ?, sa_est = ?, sec_id = ? WHERE est_id = ?";
      $datos = array($this->ced, $this->nombre, $this->pa, $this->sa, $this->seccion, $this->id);
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

  function deleteEstudiante(int $id)
  {
    $sql = "DELETE FROM estudiantes WHERE est_id = ?";
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
