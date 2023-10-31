<?php
class AsistenciaModel extends Query
{
  private  $ced,  $nombre,  $pa,  $sa, $seccion, $id, $CED_hidden;
  public function __construct()
  {
    //cargar constructor de la clase query
    parent::__construct();
  }

  public function getAsistencias()
  {
    $sql = "SELECT a.ac_id, e.ced_est, e.nom_est, e.pa_est, e.sa_est, s.num_sec, a.fec_asist FROM asistencias_comedor a INNER JOIN estudiantes e ON a.est_id = e.est_id INNER JOIN secciones s ON e.sec_id = s.sec_id;";
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
