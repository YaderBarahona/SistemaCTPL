<?php
class PrincipalModel extends Query
{
  public function __construct()
  {
    parent::__construct();
  }


  public function getTotalEstudiantes()
  {
    $sql = "SELECT count(*) from estudiantes";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getTotalUsuarios()
  {
    $sql = "SELECT count(*) from usuarios";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getTotalSecciones()
  {
    $sql = "SELECT count(*) from secciones";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function getTotalAsistencias()
  {
    $sql = "SELECT count(*) from asistencias_comedor";
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
