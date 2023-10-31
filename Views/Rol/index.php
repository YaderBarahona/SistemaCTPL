<?php include "Views/Templates/header.php"; ?>

<!--start page wrapper -->
<div class="page-wrapper">
  <div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Roles</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item active management" aria-current="page">Gestión</li>
            </li>
            <li class="breadcrumb-item active rp" aria-current="page">Roles y permisos</li>
          </ol>
        </nav>
      </div>
    </div>

    <?php
    if (isset($data['permisoCrearRol']) && is_array($data['permisoCrearRol']) && isset($data['permisoCrearRol'][0]['tp_perm'])) {
      $permisoCrearRol = $data['permisoCrearRol'][0]['tp_perm'];
    } else {
      $permisoCrearRol = '';
    }

    if (isset($data['permisoGlobalRol']) && is_array($data['permisoGlobalRol']) && isset($data['permisoGlobalRol'][0]['tp_perm'])) {
      $permisoGlobalRol = $data['permisoGlobalRol'][0]['tp_perm'];
    } else {
      $permisoGlobalRol = '';
    }
    ?>

    <?php
    if (!empty($permisoCrearRol) || !empty($permisoGlobalRol)) {
    ?>
      <button id="btnNuevoRol" class="btn btn-primary mb-2 boton new" type="button">Nuevo <i class="fas fa-plus"></i></i></i> </button>

    <?php } ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Roles</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="tblRoles" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Tipo de rol</th>
                <th>Descripción</th>
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
    if (isset($data['permisoReporteRol']) && is_array($data['permisoReporteRol']) && isset($data['permisoReporteRol'][0]['tp_perm'])) {
      $permisoReporteRol = $data['permisoReporteRol'][0]['tp_perm'];
    } else {
      $permisoReporteRol = '';
    }

    if (isset($data['permisoGlobalRol']) && is_array($data['permisoGlobalRol']) && isset($data['permisoGlobalRol'][0]['tp_perm'])) {
      $permisoGlobalRol = $data['permisoGlobalRol'][0]['tp_perm'];
    } else {
      $permisoGlobalRol = '';
    }
    ?>
    <input type="hidden" value="<?php echo $permisoReporteRol  ?>" id="permisoReporteRol">
    <input type="hidden" value="<?php echo $permisoGlobalRol  ?>" id="permisoGlobalRol">
  </div>
</div>

<!-- modal que reacciona al boton de nuevo usuario -->
<div id="nuevo_rol" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title_modal">Nuevo rol</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form action="post" id="frmRol">

          <div class="formulario__grupo" id="grupo__tipo">
            <div class="form-group formulario__grupo-input">
              <input type="hidden" id="id_rol_hidden" name="id_rol_hidden">
              <input type="hidden" id="tipo_rol_hidden" name="tipo_rol_hidden">
              <label for="inputTipoRol" class="formulario__label roleType">Tipo</label>
              <input id="inputTipoRol" class="form-control formulario__input" type="text" name="inputTipoRol" placeholder="Tipo de rol">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error rolValidation">El campo cédula permite ingresar de 1 a 30 caracteres y solo puede contener letras, numeros y guiones.</p>
          </div>

          <div class="formulario__grupo" id="grupo__descripcion">
            <div class="form-group formulario__grupo-input">
              <label for="inputDescripcion" class="form-label formulario__label description">Descripción</label>
              <!-- <textarea id="inputDescripcion" class="form-control formulario__input" type="text" name="inputDescripcion" placeholder="Descripción del rol" cols="40" rows="4"></textarea> -->
              <textarea style="height: 170px; resize: none;" id="inputDescripcion" class="form-control formulario__input" type="text" name="inputDescripcion" placeholder="Descripción del rol" rows="4" cols="40"></textarea>
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error rolDescriptionValidation">El campo descripción permite ingresar entre 1 y 100 caracteres y solo puede contener letras.</p>
          </div>

          <!--  -->
          <div class="formulario__mensaje" id="formulario__mensaje">
            <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
          </div>
          <!--  -->
          <div class="d-grid gap-2">
            <button id="btnModal" class="btn btn-primary btn-block formulario__btn boton" type="submit">Registrar</button>
            <button id="btnModal2" class="btn btn-danger btn-block formulario__btn2 boton cancel" type="button">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/modulos/roles/roles.js"></script>

<?php include "Views/Templates/footer.php"; ?>