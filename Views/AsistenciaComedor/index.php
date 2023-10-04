<?php
include "Views/Templates/header.php"; ?>
<link href="<?php echo BASE_URL; ?>Assets/css/forms.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>Assets/css/btn.css" rel="stylesheet">

<div class="container-fluid">

  <!-- Page Heading -->

  <!-- <h1 class="h3 mb-2 text-gray-800">Tabla</h1> -->

  <!-- <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Usuarios</li>
  </ol> -->
  <button id="btnNuevoEstudiante" class="btn btn-primary mb-2 boton" type="button">Nuevo <i class="fas fa-plus"></i></i> </button>
  <!-- ver lo que contiene la variable data del controlador -->
  <!-- <?php print_r($data) ?> -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Asistencias</h6>
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
              <th>Acciones</th>
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
  if (isset($data['permisoReporteUsuario']) && is_array($data['permisoReporteUsuario']) && isset($data['permisoReporteUsuario'][0]['tp_perm'])) {
    $permisoReporteUsuario = $data['permisoReporteUsuario'][0]['tp_perm'];
  } else {
    $permisoReporteUsuario = '';
  }

  if (isset($data['permisoGlobalUsuario']) && is_array($data['permisoGlobalUsuario']) && isset($data['permisoGlobalUsuario'][0]['tp_perm'])) {
    $permisoGlobalUsuario = $data['permisoGlobalUsuario'][0]['tp_perm'];
  } else {
    $permisoGlobalUsuario = '';
  }
  ?>
  <input type="hidden" value="<?php echo $permisoReporteUsuario  ?>" id="permisoReporteUsuario">
  <input type="hidden" value="<?php echo $permisoGlobalUsuario  ?>" id="permisoGlobalUsuario">
</div>

<script src="<?php echo BASE_URL; ?>Assets/js/modulos/asistencias/asistencias.js"></script>
<?php include "Views/Templates/footer.php"; ?>