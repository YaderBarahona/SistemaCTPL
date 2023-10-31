<?php
include "Views/Templates/header.php"; ?>
<link href="<?php echo BASE_URL; ?>Assets/css/forms.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>Assets/css/btn.css" rel="stylesheet">

<div class="page-wrapper">
  <div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3 al">Registro de acceso</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item active management" aria-current="page">Gestión</li>
            </li>
            <li class="breadcrumb-item active al" aria-current="page">Registro de acceso</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center al">Registro de acceso</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="tblRegistro" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Tipo de evento</th>
                <th>Navegador</th>
                <th>Dirección IP</th>
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

    if (isset($data['permisoGlobalRegistro']) && is_array($data['permisoGlobalRegistro']) && isset($data['permisoGlobalRegistro'][0]['tp_perm'])) {
      $permisoGlobalRegistro = $data['permisoGlobalRegistro'][0]['tp_perm'];
    } else {
      $permisoGlobalRegistro = '';
    }
    ?>
    <input type="hidden" value="<?php echo $permisoGlobalRegistro  ?>" id="permisoGlobalRegistro">
  </div>
</div>

<script src="<?php echo BASE_URL; ?>Assets/js/modulos/log/log.js"></script>
<?php include "Views/Templates/footer.php"; ?>