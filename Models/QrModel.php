<?php
class QrModel extends Query
{
  private $est_id, $fecha_actual;

  public function __construct()
  {
    //cargamos constructor de la instancia 
    parent::__construct();
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

  public function verificarAsistencia($ced_est)
  {
    $sql = "SELECT est_id, ced_est FROM estudiantes WHERE ced_est = '$ced_est'";
    $result = $this->select($sql);

    if ($result) {
      // El código QR coincide con un registro en la base de datos
      $est_id = $result['est_id'];
      $this->est_id = $est_id;

      $sql2 = "SELECT ac_id, est_id, fec_asist 
      FROM asistencias_comedor 
      WHERE est_id = $est_id
      AND fec_asist > DATE_SUB(NOW(), INTERVAL 20 HOUR);
      ";
      $result2 = $this->select($sql2);

      if ($result2) {
        $res = "INGRESADO";
      } else {
        $res = "NOINGRESADO";
      }
    } else {
      $res = "NOEXISTE";
    }

    return $res;
  }

  public function registrarAsistencia($ced_est)
  {

    $sql = "SELECT est_id, ced_est FROM estudiantes WHERE ced_est = '$ced_est'";
    $result = $this->select($sql);

    if ($result) {
      // El código QR coincide con un registro en la base de datos
      $est_id = $result['est_id'];
      $this->est_id = $est_id;

      // Insertar en la tabla asistencias_comedor
      date_default_timezone_set('America/Costa_Rica');
      $fecha_actual = date('Y-m-d h:i:s');
      $this->fecha_actual = $fecha_actual;

      $sql = "INSERT INTO asistencias_comedor (est_id, fec_asist) VALUES (?,?)";
      $datos = array($this->est_id, $this->fecha_actual);
      $data = $this->save($sql, $datos);

      if ($data == 1) {
        $res = "OK";
      } else {
        $res = "ERROR";
      }
    } else {
      // El código QR no coincide con ningún registro en la base de datos
      $res = "NOEXISTE";
    }

    return $res;
  }
}
