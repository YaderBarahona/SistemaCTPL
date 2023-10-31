<?php
include "Views/Templates/header.php"; ?>
<link href="<?php echo BASE_URL; ?>Assets/css/forms.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>Assets/css/btn.css" rel="stylesheet">

<div class="page-wrapper">
  <div class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3 ah">Historial Asistencia</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item active management" aria-current="page">Gestión</li>
            </li>
            <li class="breadcrumb-item active ah" aria-current="page">Historial Asistencia</li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center assists">Asistencias</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="tblAsistencias" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Sección</th>
                <th>Fecha</th>
              </tr>
            </thead>
            <tbody>
              <!--  -->
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <?php
    if (isset($data['permisoReporteAsistencia']) && is_array($data['permisoReporteAsistencia']) && isset($data['permisoReporteAsistencia'][0]['tp_perm'])) {
      $permisoReporteAsistencia = $data['permisoReporteAsistencia'][0]['tp_perm'];
    } else {
      $permisoReporteAsistencia = '';
    }

    if (isset($data['permisoGlobalAsistencia']) && is_array($data['permisoGlobalAsistencia']) && isset($data['permisoGlobalAsistencia'][0]['tp_perm'])) {
      $permisoGlobalAsistencia = $data['permisoGlobalAsistencia'][0]['tp_perm'];
    } else {
      $permisoGlobalAsistencia = '';
    }
    ?>
    <input type="hidden" value="<?php echo $permisoReporteAsistencia  ?>" id="permisoReporteAsistencia">
    <input type="hidden" value="<?php echo $permisoGlobalAsistencia  ?>" id="permisoGlobalAsistencia">
  </div>
</div>

<script src="<?php echo BASE_URL; ?>Assets/js/modulos/asistencias/asistencias.js"></script>
<?php include "Views/Templates/footer.php"; ?>